<?php
require('system/core/DBConfig.php');
require('Controllers/BaseController.php');
require('Model/User.php');
require('Model/Comment.php');
require('Model/Notification.php');
require('system/library/function.php');
class NotificationController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }
    public function index()
    {
        $user_id = $_SESSION[User::TABLE]['id'];
        $notifications = $this->db->Where(['to_user_id'=>$user_id],[Notification::TABLE],['*'],['id','desc']);
        // $notifications = $this->db->getAllData("Select a.id as 'user_id',a.first_name,a.last_name,a.username,a.profile_pic,b.id as 'notification_id',b.message,b.read_status,url,b.created_at 
        // from users a,notifications b 
        // where a.id = b.from_user_id 
        // and b.to_user_id=$user_id
        // order by b.id desc");
         $this->View('Shared/notification_canvas', $notifications);
    }
    public function Read()
    {
        if ($_POST) {
            $notification_id = $_POST['notification_id'];
            $notification = $this->db->SingleOrDefault(['id' => $notification_id], Notification::TABLE);
            if (!$notification->read_status) $notification->read_status = 1;
            $this->db->Update(Notification::TABLE, $notification);
            echo json_encode(['status' => true, 'url' => $notification->url]);
        }
    }
    public function MarkAllAsRead()
    {
        if (isset($_POST)) {
            $user_id = $_SESSION[User::TABLE]['id'];
            $notifications = $this->db->Where(['to_user_id' => $user_id, 'read_status' => 0], [Notification::TABLE]);
            foreach ($notifications as $key => $value) {
                $value->read_status=1;
                $this->db->Update(Notification::TABLE,$value);
            }
            $this->index();
        }
    }
    public function UnreadNotification()
    {
        $user_id = $_SESSION[User::TABLE]['id'];
        $notifications = $this->db->Where(['to_user_id'=>$user_id,'read_status'=>0],[Notification::TABLE],['*'],['id','desc']);
        $this->View('Shared/notification_canvas', $notifications);
    }
    public function NumberOfUnRead()
    {
        $user_id = $_SESSION[User::TABLE]['id'];
        $number = numberOfUnreadNotifications($user_id);
        if($number)
        {
            echo json_encode(['status' => true, 'number' => $number]);
        }
        else
        {
            echo json_encode(['status' => false]);
        }
    }
    public function DeleteNotification(){
        if($_POST){
                 $notification_id=$_POST['notification_id'];
                 $notification = $this->db->SingleOrDefault(['id'=>$notification_id],Notification::TABLE);
                 $this->db->Delete(Notification::TABLE,$notification);
                 echo json_encode(['status' => true]);
        }
   

    }
}
