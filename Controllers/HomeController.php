<?php
require('system/core/DBConfig.php');
require('Controllers/BaseController.php');
require('Model/User.php');
require('Model/Post.php');
require('Model/Collection.php');
require('system/library/function.php');
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
        $user = (object)$_SESSION[User::TABLE];
        $otherUsers = $this->db->getAllData("SELECT * FROM users 
                                            WHERE id NOT IN (SELECT follow_list.user_id from follow_list WHERE follower_id = $user->id)
                                             AND id !=$user->id  ORDER BY RAND()");
        $postUsers = $this->db->getAllData("SELECT user_id,first_name,last_name,username,profile_pic,posts.id as 'post_id',post_text,posts.created_at 
                                            FROM users,posts
                                            WHERE (user_id IN (SELECT follow_list.user_id from follow_list WHERE follower_id =$user->id  ) or user_id = $user->id) 
                                            AND users.id=posts.user_id 
                                            AND hidden = 0 
                                            ORDER BY posts.created_at DESC");
         $this->views('Home/index',[$user,$otherUsers,$postUsers]);
    }


}

?>