<?php
abstract class BaseController
{
    public function View($path, $model = "")
    {
        require("Views/$path.php");
    }
    public function Redirect($url, $action = 0)
    {
        if ($action == 0) {
            echo "<script>
        window.location.href = '$url';
    </script>";
        } else {
            header("location:$url");
        }
    }
    public $_GET;
    public function __construct()
    {
        $this->_GET = $this->GET_PARAM();
        if(!isset($_SESSION['users'])){
            $this->Redirect('/pictogram/signin',1);
        }
        
    }
    public function GET_PARAM()
    {
        $url = $_SERVER['REQUEST_URI'];
        $parts = parse_url($url);
        parse_str($parts['query'] ?? '', $query);
        return $query;
    }
    public function Views($path, $models=[])
    {
        require("Views/$path.php");
    }
}
