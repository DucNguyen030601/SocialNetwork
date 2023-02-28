<?php
require('system/core/DBConfig.php');
require('ad/Controllers/BaseController.php');
require('Model/User.php');
require('Model/Post.php');
require('Model/Collection.php');
require('Model/Comment.php');
require('Model/Follow.php');
require('Model/Report.php');
require('system/library/function.php');
class PostController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }
    public function PostModal()
    {
        $post_id = $this->_GET['post_id'];
        $postUser = (object)$this->db->getRow("SELECT user_id,first_name,last_name,username,profile_pic,posts.id as 'post_id',post_text,posts.created_at 
        FROM users,posts
        WHERE posts.id = $post_id
        AND users.id=posts.user_id");
        $collections = $this ->db->Where(['post_id' => $post_id], [Collection::TABLE]);
        $comments = getAllComments($post_id);
         $this->Views('Shared/post_modal',[$postUser,$collections,$comments]);
    }
    public function DeletePost()
    {
        if ($_POST) {
            $post_id = $_POST['post_id'];
            $post =$this->db->SingleOrDefault(['id'=>$post_id],Post::TABLE);
            $collections = $this->db->Where(['post_id'=>$post_id],[Collection::TABLE]);
            foreach ($collections as $key => $value) {
                unlink("upload/user$post->user_id/".$value->file_name);
                $collection =$this->db->SingleOrDefault(['id'=>$value->id],Collection::TABLE);
                $this->db->Delete(Collection::TABLE,$collection);
            }
            $this->DeleteReport($post_id,1);
            if($this->db->Delete(Post::TABLE,$post)) echo json_encode(['status' => true]);
            else echo json_encode(['status' => false]);
        }
    }
    public function DeleteReport($post_id,$type){
        if($type==1) $reports = $this->db->getAllData("SELECT * from report_list where type_id=$post_id and (type=1 or type = 3)");
        if($type==2) $reports = $this->db->getAllData("SELECT * from report_list where type_id=$post_id and type=2");
            foreach ($reports as $key => $value) {
                $this->db->Delete(Report::TABLE,$value);
            }
    }
    public function DeleteComment()
    {
        if ($_POST) {
            $comment_id = $_POST['comment_id'];
            $comment =$this->db->SingleOrDefault(['id'=>$comment_id],Comment::TABLE);
            $this->DeleteReport($comment_id,2);
            $this->db->Delete(Comment::TABLE,$comment);
            $numberOfComments = numberOfComments($comment->post_id);
            echo json_encode(['status' => true,'numberOfComments' => $numberOfComments]);
        }
    }
}

?>