<?php
require('system/core/DBConfig.php');
require('Controllers/BaseController.php');
require('Model/User.php');
require('Model/Like.php');
require('Model/Post.php');
require('Model/Notification.php');
require('system/library/function.php');
class LikeController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }
    public function Like()
    {
        if($_POST)
        {
            $like = new Like($_POST);
            $like->user_id=$_SESSION[User::TABLE]['id'];
            $islike = $this->db->SingleOrDefault(['post_id'=>$like->post_id,'user_id'=>$like->user_id],Like::TABLE);
          
            if((array)$islike)
            {
                $this->db->Delete(Like::TABLE,$islike);  
                $numberOfLikes = numberOfLikes($like->post_id);
                echo json_encode(['status'=>false,'numberOfLikes'=>$numberOfLikes]);
            }
            else
            {
                $this->db->Add(Like::TABLE,$like);
                $numberOfLikes = numberOfLikes($like->post_id);
                if(!checkUserPost($like->post_id,$like->user_id))
                {
                    $notification = new Notification();
                    $notification->from_user_id = $like->user_id;
                    $notification->to_user_id = ($this->db->SingleOrDefault(['id'=>$like->post_id],Post::TABLE))->user_id;
                    $notification->message ='liked your post.';
                    $notification->url='/pictogram/post?post_id='.$like->post_id;
                    $this->db->Add(Notification::TABLE,$notification);
                }
                echo json_encode(['status'=>true,'numberOfLikes'=>$numberOfLikes]);
            }

        }

    }
    public function LikeModal()
    {
        $post_id = $this->_GET['post_id'];
        $likes = $this->db->Where(['post_id'=>$post_id,'user_id'=>['users.id',1]],[User::TABLE, Like::TABLE],['users.id','first_name','last_name','username','profile_pic'],['likes.id','desc']);
         $this->View('Shared/like_modal',$likes);
        
    }



}

?>