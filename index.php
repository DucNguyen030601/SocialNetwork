<?php

$controllerName = ucfirst(($_REQUEST['controller'] ?? 'Home') . 'Controller');
if ($controllerName == 'AdminController') {
    $controllerName = ucfirst(($_REQUEST['action'] ?? 'Home') . 'Controller');
    $actionName = strtolower($_REQUEST['action_admin'] ?? 'index');
    $dir = "ad/Controllers/$controllerName.php";
    if (file_exists($dir)) {
        require_once("ad/Controllers/$controllerName.php");
        $controllerObject = new $controllerName();
        $controllerObject->$actionName();
    } else {
        require('Views/Shared/page_not_found.php');
    }

} else {
    $actionName = strtolower($_REQUEST['action'] ?? 'index');
    $dir = "Controllers/$controllerName.php";
    if (file_exists($dir)) {
        require_once("Controllers/$controllerName.php");
        $controllerObject = new $controllerName();
        $controllerObject->$actionName();
    } else {
        require('Views/Shared/page_not_found.php');
    }
}
?>