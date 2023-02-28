<?php
require('system/core/DBConfig.php');
require('Controllers/BaseController.php');
require('Model/User.php');
require('Model/Post.php');
require('Model/Collection.php');
require('Model/Follow.php');
require('Model/Notification.php');
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
    public function index()
    {
        $post_id = $this->_GET['post_id'];
        $post = $this->db->getRow("SELECT user_id,first_name,last_name,username,profile_pic,posts.id as 'post_id',post_text,posts.created_at,hidden  
        FROM users,posts 
        WHERE users.id = posts.user_id 
        AND posts.id =$post_id");
        if($post){
            if($post['user_id']==$_SESSION[User::TABLE]['id']){
                $this->view('Post/index',(object)$post);
            }
            else if($post['hidden']==1){
                $this->view('Shared/post_not_found');
            }
            else{
                $this->view('Post/index',(object)$post);
            }
        } 
        else  $this->view('Shared/post_not_found');
    }
    //for post status
    public function AddPost()
    {
        if ($_POST) {
            $post = new Post($_POST);
            $post->user_id=$_SESSION[User::TABLE]['id'];
            $this->db->Add(Post::TABLE,$post);
            $post->id = $this->db->getID();
            if ($_FILES['doc']['size'][0]) {
                $collection = new Collection();
                $collection->post_id = $post->id;
                foreach ($_FILES['doc']['name'] as $key => $val) {
                    $rand = rand(11111111,99999999);
                    $file = $rand.$val;
                    move_uploaded_file($_FILES['doc']['tmp_name'][$key],"upload/user$post->user_id/".$file);
                    $collection->file_name=$file;
                    if ($_FILES['doc']['type'][$key] == 'video/mp4') {
                        $collection->type=0;
                    }
                    else {
                        $collection->type=1;
                    }
                    $this->db->Add(Collection::TABLE,$collection);
                }
            }
            if(isCheckSwearing($post->post_text)){
                $post->hidden = 1;
                $this->db->Update(Post::TABLE,$post);
                $notification = new Notification();
                $notification->to_user_id = $post->user_id;
                $notification->from_user_id = -1;
                $notification->message = "Your post has been hidden because it contains sensitive words. After 24 hours waiting for admin approval.";
                $notification->url="/pictogram/post?post_id=$post->id";
                $this->db->Add(Notification::TABLE,$notification);
                $this->AddReport($post->id,$post->user_id);
                ShowAlert("Your post has been hidden by the admin!");
            }
            else
            {
                $notification = new Notification();
                $notification->from_user_id = $post->user_id;
                $notification->url="/pictogram/post?post_id=$post->id";
                $this->db->Add(Notification::TABLE,$post);
                $follower = $this->db->Where(['user_id'=>$post->user_id],[Follow::TABLE]);
                foreach ($follower as $key => $value) {
                    $notification->to_user_id = $value->follower_id;
                    $notification->message = "just posted a new post!";
                    $this->db->Add(Notification::TABLE,$notification);
                }
                ShowAlert("Post status successful!");
            }
            $this->Redirect("/pictogram/");
        }
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
            $this->DeleteReport($post_id);
            if($this->db->Delete(Post::TABLE,$post)) echo json_encode(['status' => true]);
            else echo json_encode(['status' => false]);
        }
    }
    public function DeleteReport($post_id){
        $reports = $this->db->getAllData("SELECT * from report_list where type_id=$post_id and (type=1 or type = 3)");
            foreach ($reports as $key => $value) {
                $this->db->Delete(Report::TABLE,$value);
            }
    }
    public function AddReport($post_id,$user_id){
        $report = new Report();
        $report->type_id = $post_id;
        $report->type = 3;
        $report->reporter_id = -1;
        $report->user_id = $user_id;
        $this->db->Add(Report::TABLE,$report);
    }
 
    
    
}

?>