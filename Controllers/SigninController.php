<?php
require('system/core/DBConfig.php');
require('system/library/function.php');
require('system/library/send_code.php');
require('Controllers/BaseController.php');
require('Model/User.php');

class SigninController extends BaseController{
    private $db;
    function __construct()
    {
        $this->db = new Database();
        if(isset($_SESSION[User::TABLE])) unset($_SESSION[User::TABLE]);
    }
    public function index()
    {
        if(!$_POST)  $this->view('Signin/index',new User());
        else
        {
            $user = new User($_POST);
            if(!validateSigninForm($_POST))
            {
                $user = $this->db->SingleOrDefault(["password"=>md5($user->password),"username"=>$user->username],User::TABLE);
                if($user->ac_status==2)
                {
                     $this->View('Shared/blocked',$user);
                }
                else if($user->ac_status==0)
                {
                    SendMail($user->email);
                    $_SESSION['signin']['email'] = $user->email;
                     $this->Redirect('signin/verifyemail',1);
                }
                else{
                    $_SESSION[User::TABLE]=(array)$user;
                    ShowAlert('Hi '.$_SESSION[User::TABLE]['first_name'].' '.$_SESSION[User::TABLE]['last_name'].'!');
                    $this->Redirect('home');
                }
            }
             $this->View('Signin/index',$user);
        }
    }
    public function forgotpassword()
    {
        if(!$_POST)  $this->view('Signin/forgotpassword',new User());
        else
        {
            $user = new User($_POST);
            if(!validateForgotPasswordForm($_POST))
            {
                SendMail($user->email);
                $_SESSION['signin']['resetpassword']=1;
                $_SESSION['signin']['email'] = $user->email;
                 $this->Redirect('verifyemail',1);
            }
             $this->View('Signin/forgotpassword',$user);
        }
    }
    public function resetpassword()
    {
        if(isset($_SESSION['signin']['resetpassword']))
        {
            $user = new User($_SESSION['signin']);
            if(!$_POST)  $this->view('Signin/resetpassword',$user);
            else
            {
                if(!validateResetPasswordForm($_POST))
                {
                    $user = $this->db->SingleOrDefault(['email'=>$_SESSION['signin']['email']],User::TABLE);
                    $user->password=md5($_POST['password']);
                    $user->updated_at=date('Y/m/d H:i:s', time());
                    $this->db->Update(User::TABLE,$user);
                    $_SESSION[User::TABLE]=(array)$user;
                    unset($_SESSION['signin']['resetpassword']);
                     $this->Redirect('../wall');
                }
                 $this->View('Signin/resetpassword',$user);
            }
        }
    }
    public function verifyemail()
    {
        if(isset($_SESSION['signin']['email']))
        {
            $user =  new User($_SESSION['signin']);
            if(!$_POST)  $this->view('Signin/verifyemail',$user);
            else
            {
                if(!validateVerifyEmailForm($_POST))
                {
                    if(!isset($_SESSION['signin']['resetpassword']))
                    {
                        $user = $this->db->SingleOrDefault(['email'=>$user->email],User::TABLE);
                        $user->ac_status=1;
                        $user->updated_at=date('Y/m/d H:i:s', time());
                        $this->db->Update(User::TABLE,$user);
                        $_SESSION[User::TABLE]=(array)$user;
                        ShowAlert('Hi '.$_SESSION[User::TABLE]['first_name'].' '.$_SESSION[User::TABLE]['last_name'].'!');
                        unset($_SESSION['signin']['email']);
                        $this->Redirect('../home');
                    }
                    else
                    {
                        $this->Redirect('resetpassword');
                    }
                }
                 $this->View('Signin/verifyemail',$user);
            }
        }

    }
}

?>