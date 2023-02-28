<?php
require('system/core/DBConfig.php');
require('Controllers/BaseController.php');
require('Model/User.php');
require('Model/Message.php');
require('system/library/function.php');
class MessageController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }
    public function ActiveChatUsers()
    {
        $user_id = $_SESSION[User::TABLE]['id'];
        $actives = getActiveChatUsers($user_id);
        $this->View('Shared/message_canvas', $actives);
    }
    public function ActiveChatUsersRequest()
    {
        $user_id = $_SESSION[User::TABLE]['id'];
        $actives = getActiveChatUsersRequest($user_id);
        $this->View('Shared/message_canvas', $actives);
    }

    public function NumberOfUnRead()
    {
        $user_id = $_SESSION[User::TABLE]['id'];
        $number = numberOfUnreadMessages($user_id);
        if ($number) {
            echo json_encode(['status' => true, 'number' => $number]);
        } else {
            echo json_encode(['status' => false]);
        }
    }
    public function NumberOfUnReadRequest()
    {
        $user_id = $_SESSION[User::TABLE]['id'];
        $number = numberOfUnreadMessagesRequest($user_id);
        if ($number) {
            echo json_encode(['status' => true, 'number' => $number]);
        } else {
            echo json_encode(['status' => false]);
        }
    }

    public function ChatModal()
    {
        $to_user_id = $_SESSION[User::TABLE]['id'];
        $from_user_id = $this->_GET['from_user_id'];
        $this->Read($from_user_id, $to_user_id);
        $to_user = getUser($to_user_id);
        $from_user = getUser($from_user_id);
        $messages = getMessages($from_user_id, $to_user_id);
        $request = in_array($from_user_id, getActiveChatUserIdsRequest($to_user_id));
        $this->Views('Shared/chat_modal', [$from_user, $to_user, $messages, $request]);
    }
    public function AddMessage()
    {
        if ($_POST) {
            $message = new Message($_POST);
            $message->from_user_id = $_SESSION[User::TABLE]['id'];
            if (!isCheckFollower($message->to_user_id, $message->from_user_id)) {
                $message->request=1;
                if (isCheckMessageRequests($message->from_user_id, $message->to_user_id,false)) {
                    $message->request = 0;
                } else if (isCheckMessageRequests($message->to_user_id, $message->from_user_id)) {
                    $message->request = 0;
                    $this->UpdateMessageRequests($message->to_user_id, $message->from_user_id);
                }
            }
            else if (isCheckMessageRequests($message->to_user_id, $message->from_user_id)) {
                    $message->request = 0;
                    $this->UpdateMessageRequests($message->to_user_id, $message->from_user_id);
            }
            if ($this->db->Add(Message::TABLE, $message)) {
                echo json_encode(['status' => true, 'count' => count(getMessages($message->from_user_id, $message->to_user_id))]);
            } else echo json_encode(['status' => false]);
        }
    }
    public function Read($from_user_id, $to_user_id)
    {
        $messages = $this->db->Where(['to_user_id' => $to_user_id, 'from_user_id' => $from_user_id, 'read_status' => 0], [Message::TABLE]);
        foreach ($messages as $key => $value) {
            $value->read_status = 1;
            $this->db->Update(Message::TABLE, $value);
        }
    }
    public function LoadChat()
    {
        $to_user_id = $_SESSION[User::TABLE]['id'];
        $from_user_id = $this->_GET['from_user_id'];
        $messages = $this->db->Where(['to_user_id' => $to_user_id, 'from_user_id' => $from_user_id, 'read_status' => 0], [Message::TABLE]);
        if (count($messages)) {
            $json['read_status'] = true;
            $this->Read($from_user_id, $to_user_id);
        } else $json['read_status'] = false;
        if (checkBlockStatusByUserAndUserFound($to_user_id, $from_user_id)) $json['blocked'] = true;
        else $json['blocked'] = false;
        $json['count'] = count(getMessages($from_user_id, $to_user_id));
        echo json_encode($json);
    }
    public function index()
    {
        $to_user_id = $_SESSION[User::TABLE]['id'];
        $from_user_id = $this->_GET['from_user_id'];
        $this->Read($from_user_id, $to_user_id);
        $to_user = getUser($to_user_id);
        $from_user = getUser($from_user_id);
        $messages = getMessages($from_user_id, $to_user_id);
        $request = in_array($from_user_id, getActiveChatUserIdsRequest($to_user_id));
        $this->Views('Message/index', [$from_user, $to_user, $messages, $request]);
    }
    public function SearchMessengers()
    {
        $user_id = $_SESSION[User::TABLE]['id'];
        $keyword = $_POST['keyword'];
        $active_messengers = getActiveChatMessengers($user_id);
        $data = array();
        if ($keyword) {
            foreach ($active_messengers as $key => $value) {
                if (strpos($value['user']->username, $keyword) !== false || strpos($value['user']->first_name, $keyword) !== false || strpos($value['user']->last_name, $keyword) !== false  || strpos($value['user']->first_name.' '.$value['user']->last_name, $keyword) !== false)
                    $data[] = $value;
            }
        } else $data = $active_messengers;
        $this->View('Message/searchmessager', $data);
    }
    public function UpdateMessageRequests($from_user_id, $to_user_id)
    {
        $messages = $this->db->getAllData("SELECT * from messages where (from_user_id = $from_user_id and to_user_id = $to_user_id) ");
        foreach ($messages as $key => $value) {
            $value->request = 0;
            $this->db->Update(Message::TABLE, $value);
        }
    }
}
