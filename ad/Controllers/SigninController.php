<?php
require('system/core/DBConfig.php');
require('system/library/function_ad.php');
require('ad/Controllers/BaseController.php');
require('Model/Admin.php');
class SigninController extends BaseController{
    private $db;
    function __construct()
    {
        $this->db = new Database();
        if(isset($_SESSION[Admin::TABLE])) unset($_SESSION[Admin::TABLE]);
    }
    public function index()
    {
        if(!$_POST)  $this->view('Signin/index',new Admin());
        else
        {
            $admin = new Admin($_POST);
            if(!validateSigninForm($_POST))
            {
                    $admin = $this->db->SingleOrDefault(["password"=>md5($admin->password),"email"=>$admin->email],Admin::TABLE);
                    $_SESSION[Admin::TABLE]=(array)$admin;
                    ShowAlert('Hi '.$_SESSION[Admin::TABLE]['full_name'].'!');
                    $this->Redirect('home');
            }
             $this->View('Signin/index',$admin);
        }
    }
}