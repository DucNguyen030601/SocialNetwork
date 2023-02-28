<?php
require('system/core/DBConfig.php');
require('ad/Controllers/BaseController.php');
require('system/library/function_ad.php');
require('Model/User.php');
class HomeController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }
    public function index()
    {
        $totalUsers = total('users');
        $totalPosts = total('posts');
        $totalComments = total('comments');
        $totalLikes = total('likes');
        $users = $this->db->Show(User::TABLE,['id','first_name','last_name','username','profile_pic','email','created_at','ac_status'],['id','desc']);
        $this->views('Home/index',[$totalUsers,$totalPosts,$totalComments,$totalLikes,$users]);
    }
    public function ActionUser(){
        if($_POST){
            $user_id = $_POST['user_id'];
            $user = $this->db->SingleOrDefault(['id'=>$user_id],User::TABLE);
            $user->ac_status = $_POST['ac_status'];
            if($this->db->Update(User::TABLE,$user)){
                echo json_encode(['status'=>true]);
            }
            else echo json_encode(['status'=>false]);
        }
    }
    public function LoginUser(){
        if($_POST){
            $user_id = $_POST['user_id'];
            $user = $this->db->SingleOrDefault(['id'=>$user_id],User::TABLE);
            if((array)$user){
            $_SESSION[User::TABLE]=(array)$user;
            echo json_encode(['status'=>true,'first_name'=>$user->first_name,'last_name'=>$user->last_name]);}
            else echo json_encode(['status'=>false]);
        }
    }
}
?>