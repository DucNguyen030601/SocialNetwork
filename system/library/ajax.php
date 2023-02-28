<?php
//check digit code - verify email
if(isset($_GET['checkdigitcode']))
{
    $code = $_SESSION['resendcode'];
    if(empty($_POST['code'])) return 1;
    if($code==$_POST['code'])
    {
        return 2;
    }
    return 3;
}

//insert the list_follow
if($_POST)
{
    $response['status']=true;
    echo json_encode($response);    
}

?>
