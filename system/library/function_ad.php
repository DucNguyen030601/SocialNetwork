<?php
$db = new Database();
function showPage($path, $model = "")
{
    require("ad/Views/Shared/$path.php");
}
//for show alert
function ShowAlert($alert)
{
    echo "<script>alert('$alert')</script>";
}
//for validating the signup form
function validateSigninForm($form_data)
{
    $s = '';
    if (!$form_data['email'])
        $s = 'email is not given!';
    else if (!$form_data['password'])
        $s = 'password is not given!';
    else if (!isSignin($form_data['email'], $form_data['password']))
        $s = 'email or password is incorrect!';
    return $s;
}
function showValidateSigninForm()
{
    if ($_POST)
        echo '<div class="alert alert-danger my-2" role="alert" >' . validateSigninForm($_POST) . '</div>';
}
//for checking signin
function isSignin($email, $password)
{
    global $db;
    $password = md5($password);
    $query = "SELECT *  FROM admin Where email ='$email' and password ='$password'";
    if ($db->getRow($query))
        return true;
    return false;
}

//for total
function total($table){
    global $db;
    return $db->getRow("select count(*) as 'number' from $table")['number'];
}

//for status user
function StatusUser($status){
    if($status==1) echo '<button class = "btn btn-outline-primary">Active <i class="far fa-check-circle"></i></button>';
    if($status==0) echo '<button class = "btn btn-outline-warning">Verify <i class="fas fa-exclamation-circle"></i></button>';
    if($status==2) echo '<button class = "btn btn-outline-danger">Block <i class="fas fa-lock"></i></button>';
}
function ActionUser($status,$user_id){
    if($status==1){
        echo '<button class = "btn btn-warning" onclick="ActionUser('.$user_id.',0)">Verify <i class="fas fa-exclamation-circle"></i></button> ';
        echo '<button class = "btn btn-danger" onclick="ActionUser('.$user_id.',2)">Block <i class="fas fa-lock"></i></button> ';
    }
    if($status==0){
        echo '<button class = "btn btn-primary"onclick="ActionUser('.$user_id.',1)">Active <i class="far fa-check-circle"></i></button> ';
        echo '<button class = "btn btn-danger"onclick="ActionUser('.$user_id.',2)">Block <i class="fas fa-lock"></i></button> ';
    }
    if($status==2){
        echo '<button class = "btn btn-primary"onclick="ActionUser('.$user_id.',1)">Active <i class="far fa-check-circle"></i></button> ';
        echo '<button class = "btn btn-warning"onclick="ActionUser('.$user_id.',0)">Verify <i class="fas fa-exclamation-circle"></i></button> ';
    }
}

?>