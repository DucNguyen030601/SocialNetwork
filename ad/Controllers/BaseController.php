<?php
abstract class BaseController
{
    public function View($path, $model = "")
    {
        require("ad/Views/$path.php");
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
        if(!isset($_SESSION['admin'])){
            $this->Redirect('/pictogram/admin/signin',1);
        }
        $this->_GET = $this->GET_PARAM();
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
        require("ad/Views/$path.php");
    }
}
