<?php
require('Controllers/BaseController.php');
require('system/core/DBConfig.php');
require('Model/User.php');
require('Model/Post.php');
require('Model/Collection.php');
require('Model/Follow.php');
require('system/library/function.php');

class AccountController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }
    public function index()
    { 
        $user = new User($_SESSION[User::TABLE]);
        $username = isset($this->_GET['user'])?$this->_GET['user']:$user->username;
        $userFound = $this->db->SingleOrDefault(['username'=>$username],User::TABLE);
        if((array)$userFound)
        {
            $posts = $this->db->getAllData("SELECT user_id,first_name,last_name,username,profile_pic,posts.id as 'post_id',post_text,posts.created_at 
                                            FROM users,posts 
                                            WHERE users.id = posts.user_id 
                                            AND users.id =$userFound->id 
                                            AND hidden = 0
                                            ORDER by posts.created_at DESC");
            $collections = $this->db->Where(['posts.id'=>['post_id',1],'posts.user_id'=>$userFound->id ], [Collection::TABLE,Post::TABLE],["collections.id as 'collection_id'",'post_id','post_text','file_name','type'],['collections.id','desc']);
            $followers = $this->db->Where(['user_id'=>$userFound->id,'follower_id'=>['users.id',1]],[User::TABLE, Follow::TABLE],['users.id','first_name','last_name','username','profile_pic'],['users.id','desc']);
            $following = $this->db->Where(['follower_id'=>$userFound->id,'user_id'=>['users.id',1]],[User::TABLE, Follow::TABLE],['users.id','first_name','last_name','username','profile_pic'],['users.id','desc']);
             $this->Views('Account/index',[$userFound,$posts,$collections,$user,$followers,$following]);
        }
        else
        {
             $this->view('Shared/user_not_found');
        }
    }
    public function editprofile()
    {
        $user = new User($_SESSION[User::TABLE]);
        if(!$_POST)  $this->View('Account/editprofile',$user);
        else
        {
            $user->first_name=$_POST['first_name'];
            $user->last_name=$_POST['last_name'];
            $user->username=$_POST['username'];
            $user->updated_at=date('Y/m/d H:i:s', time());
            if(!validateUpdateForm((array)$user,$_FILES['profile_pic']))
            {
                if($_FILES['profile_pic']['size']){
                    $_FILES['profile_pic']['name']=rand(11111111,99999999).$_FILES['profile_pic']['name'];
                    UpdateProfilePic($_FILES['profile_pic'],$user);
                    $user->profile_pic=$_FILES['profile_pic']['name'];
                }
                if(!empty($_POST['password']))
                {
                    $user->password=md5($_POST['password']);
                }
                $this->db->Update(User::TABLE,$user);
                ShowAlert('Update successful!'); 
                $_SESSION[User::TABLE]=(array)$user;
                $this->Redirect("editprofile");
            } 
           $this->View('Account/editprofile',$user);
        }
    }
}
?>