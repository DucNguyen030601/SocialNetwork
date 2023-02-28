<?php
require('system/core/DBConfig.php');
require('Controllers/BaseController.php');
require('system/library/function.php');
class SearchController extends BaseController
{
    private $db;
    function __construct()
    {
        parent::__construct();
        $this->db = new Database();
    }
    public function index()
    {
        if($_POST)
        {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM users WHERE username LIKE '%".$keyword."%' || (first_name LIKE '%".$keyword."%' || last_name LIKE '%".$keyword."%') LIMIT 5";
        $search = $this->db->getAllData($query);
         $this->View('Search/index',$search);
        }
    }

}
