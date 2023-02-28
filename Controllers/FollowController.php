<?php
require('system/core/DBConfig.php');
require('Controllers/BaseController.php');
require('Model/User.php');
require('Model/Follow.php');
require('Model/Message.php');
require('Model/Notification.php');
require('system/library/function.php');
class FollowController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }
    public function index()
    {
        $follower_id = $_SESSION[User::TABLE]['id'];
        $user_id = $_GET['user_id'];
        
         $this->view('Home/index');
    }
    public function AddFollow()
    {
        if($_POST)
        {
            $follow = new Follow($_POST);
            $follow->follower_id=$_SESSION[User::TABLE]['id'];
            if( $this->db->Add(Follow::TABLE,$follow)){
                $notification = new Notification();
                $notification->from_user_id = $follow->follower_id;
                $notification->to_user_id = $follow->user_id;
                $notification->message ='followed you.';
                $notification->url='/pictogram/account?user='.($this->db->SingleOrDefault(['id'=>$follow->follower_id],User::TABLE))->username;
                $this->db->Add(Notification::TABLE,$notification);
                $this->UpdateMessageRequests($follow->user_id,$follow->follower_id);
                echo json_encode(['status'=>true]);
            }
        }
    }
    public function DeleteFollow()
    {
        if($_POST)
        {
            $follower = $this->db->SingleOrDefault(['follower_id'=>$_SESSION[User::TABLE]['id'],'user_id'=>$_POST['user_id']],Follow::TABLE);
            $this->db->Delete(Follow::TABLE,$follower);
            echo json_encode(['status'=>true]);
        }
    }
    public function UpdateMessageRequests($from_user_id, $to_user_id){
        $messages = $this->db->Where(['to_user_id' => $to_user_id, 'from_user_id' => $from_user_id, 'request' => 1], [Message::TABLE]);
        foreach ($messages as $key => $value) {
            $value->request = 0;
            $this->db->Update(Message::TABLE, $value);
        }
    }
}

?>