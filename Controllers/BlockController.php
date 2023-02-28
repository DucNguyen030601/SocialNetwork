<?php
require('system/core/DBConfig.php');
require('Controllers/BaseController.php');
require('Model/User.php');
require('Model/Follow.php');
require('Model/Block.php');
require('system/library/function.php');
class BlockController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();   
        $this->db = new Database();
    }

    public function Block()
    {
        if($_POST)
        {
            $block = new Block($_POST);
            $block->user_id=$_SESSION[User::TABLE]['id'];
            $this->db->Add(Block::TABLE,$block);
            $following = $this->db->SingleOrDefault(['follower_id'=>$block->user_id,'user_id'=>$block->blocked_user_id],Follow::TABLE);
            $this->db->Delete(Follow::TABLE,$following);
            $follower = $this->db->SingleOrDefault(['user_id'=>$block->user_id,'follower_id'=>$block->blocked_user_id],Follow::TABLE);
            $this->db->Delete(Follow::TABLE,$follower);
            echo json_encode(['status'=>true]);
        }
    }
    public function UnBlock()
    {
        if($_POST)
        {
            $block = $this->db->SingleOrDefault(['user_id'=>$_SESSION[User::TABLE]['id'],'blocked_user_id'=>$_POST['blocked_user_id']],Block::TABLE);
            $this->db->Delete(Block::TABLE,$block);
            echo json_encode(['status'=>true]);
        }
    }


}

?>