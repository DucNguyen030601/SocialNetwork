<?php
require('system/core/DBConfig.php');
require('Controllers/BaseController.php');
require('Model/User.php');
require('Model/Comment.php');
require('Model/Post.php');
require('Model/Report.php');
require('Model/Notification.php');
require('system/library/function.php');
class CommentController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }
    public function AddComment()
    {
        if ($_POST) {
            $comment = new Comment($_POST);
            $comment->user_id = $_SESSION[User::TABLE]['id'];
            $this->db->Add(Comment::TABLE, $comment);
            $numberOfComments = numberOfComments($comment->post_id);
            $comment_id = $this->db->getID();
            $commentator = $this->db->getRow("Select b.user_id,a.first_name,a.last_name,a.username,a.profile_pic,b.comment,b.created_at from users a,comments b where a.id = b.user_id and b.id=$comment_id");
            if(!checkUserPost($comment->post_id,$comment->user_id))
            {
                $notification = new Notification();
                $notification->created_at = $comment->created_at;
                $notification->from_user_id = $comment->user_id;
                $notification->to_user_id = ($this->db->SingleOrDefault(['id'=>$comment->post_id],Post::TABLE))->user_id;
                $notification->message ='commented on your post.';
                $notification->url='/pictogram/post?post_id='.$comment->post_id.'&comment_id='.$comment_id;
                $this->db->Add(Notification::TABLE,$notification);
            }
            echo json_encode(['status' => true, 'numberOfComments' => $numberOfComments,'commentator'=>$commentator]);
        }
    }
    public function DeleteComment()
    {
        if ($_POST) {
            $comment_id = $_POST['comment_id'];
            $comment =$this->db->SingleOrDefault(['id'=>$comment_id],Comment::TABLE);
            $this->DeleteReport($comment_id);
            $this->db->Delete(Comment::TABLE,$comment);
            $numberOfComments = numberOfComments($comment->post_id);
            echo json_encode(['status' => true,'numberOfComments' => $numberOfComments]);
        }
    }
    
    public function index()
    {
        $post_id = $this->_GET['post_id'];
        $comments = getAllComments($post_id);
        $this->View('Comment/index',$comments);
    }
    public function DeleteReport($comment_id){
        $reports = $this->db->Where(['type_id'=>$comment_id,'type'=>2],[Report::TABLE]);
            foreach ($reports as $key => $value) {
                $this->db->Delete(Report::TABLE,$value);
            }
    }
}
