<?php

use function PHPSTORM_META\type;

require('system/core/DBConfig.php');
require('ad/Controllers/BaseController.php');
require('system/library/function_ad.php');
require('Model/User.php');
require('Model/Collection.php');
class ReportController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }
    public function User()
    {
        $users = $this->db->getAllData("SELECT users.id,first_name,last_name,username,profile_pic,email,created_at,ac_status,type,count(user_id) as 'count' from users,report_list 
        where users.id = report_list.user_id 
        and type = 0 
        group by user_id 
        order by report_list.id desc");
        $this->view('Report/user',$users);
    }
    public function Post()
    {
        $posts = $this->db->getAllData("SELECT users.id,first_name,last_name,username,profile_pic,email,post_text,type_id,type,posts.created_at,count(type_id) as 'count' from users,report_list,posts 
        where users.id = report_list.user_id 
        AND posts.id = report_list.type_id
        and type = 1 
        group by type_id
        order by report_list.id desc");
        $this->view('Report/post',$posts);
    }
    public function Comment()
    {
        $comments = $this->db->getAllData("SELECT users.id,first_name,last_name,username,profile_pic,email,comment,type_id,type,post_id,comments.created_at,count(type_id) as 'count' from users,report_list,comments 
        where users.id = report_list.user_id 
        AND comments.id = report_list.type_id
        and type = 2 
        group by type_id
        order by report_list.id desc");
        $this->view('Report/comment',$comments);
    }
    public function Reporter(){ 

        $type = $this->_GET['type'];
        $type_id = $this->_GET['type_id'];
        $name_type = $type==0?'user_id':'type_id';
        $reporters = $this->db->getAllData("SELECT users.id,first_name,last_name,username,profile_pic,email from users,report_list where 
        reporter_id = users.id 
        and type = $type
        and $name_type = $type_id
        order by report_list.id");
        $this->view('Report/reporter',$reporters);
    }
    public function Admin(){
        $posts = $this->db->getAllData("SELECT users.id,first_name,last_name,username,profile_pic,email,post_text,type_id,type,posts.created_at,count(type_id) as 'count' from users,report_list,posts 
        where users.id = report_list.user_id 
        AND posts.id = report_list.type_id
        and type = 3 
        group by type_id
        order by report_list.id desc");
        $this->view('Report/admin',$posts);
    }


}

?>