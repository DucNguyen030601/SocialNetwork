<?php
require('Controllers/BaseController.php');
require('system/core/DBConfig.php');
require('Model/User.php');
require('system/library/function.php');

class SignUpController extends BaseController
{
    private $db;
    function __construct()
    {
        $this->db = new Database();
    }
    public function index()
    { 
        
        if(!$_POST)  $this->view('SignUp/index',new User());
        else
        {
            $user = new User($_POST);
            if(!validateSignupForm($_POST))
            {
                $user->password = md5($user->password);
                $this->db->Add(User::TABLE,$user);
                SaveDefaultProfile($this->db->getID());
                $_SESSION[User::TABLE] = (array)$this->db->SingleOrDefault(["password"=>$user->password,"username"=>$user->username],User::TABLE);
                ShowAlert('Successfully created a new account! '.'Hi '.$_SESSION[User::TABLE]['first_name'].' '.$_SESSION[User::TABLE]['last_name'].'!');
                $this->Redirect('wall');
            }
           $this->View('Signup/index',new User($_POST));
        }
    }
    
}
?>