<?php
$db = new Database();
function showPage($path, $model = "")
{
    require("Views/Shared/$path.php");
}
//for save file
function SaveDefaultProfile($id)
{
    mkdir("upload/user$id", 0777, true);
    copy("public/images/default_profile.jpg", "upload/user$id/default_profile.jpg");
}

//for show alert
function ShowAlert($alert)
{
    echo "<script>alert('$alert')</script>";
}
//for checking duplicate email
function isEmailRegistered($email)
{
    global $db;
    $query = "SELECT * FROM users Where email ='$email'";
    if ((array)$db->getRow($query))
        return true;
    return false;
}

//for checking duplicate email
function isUsernameRegistered($username)
{
    global $db;
    $query = "SELECT *  FROM users Where username ='$username'";
    if ($db->getRow($query))
        return true;
    return false;
}
function isUsernameRegisteredByOther($username, $email)
{
    global $db;
    $query = "SELECT *  FROM users Where username ='$username' and email != '$email'";
    if ($db->getRow($query))
        return true;
    return false;
}
//for checking signin
function isSignin($username, $password)
{
    global $db;
    $password = md5($password);
    $query = "SELECT *  FROM users Where username ='$username' and password ='$password'";
    if ($db->getRow($query))
        return true;
    return false;
}
//for validating the signup form
function validateSignupForm($form_data)
{
    $s = '';
    if (!$form_data['first_name'])
        $s = 'first name is not given!';
    else if (!$form_data['last_name'])
        $s = 'last name is not given!';
    else if (!$form_data['email'])
        $s = 'email is not given!';
    else if (!$form_data['username'])
        $s = 'user name is not given!';
    else if (!$form_data['password'])
        $s = 'password name is not given!';
    else if (isEmailRegistered($form_data['email']))
        $s = 'email id is already registered!';
    else if (isUsernameRegistered($form_data['username']))
        $s = 'username id is already registered!';
    return $s;
}
function showValidateSignupForm()
{
    if ($_POST)
        echo '<div class="alert alert-danger my-2" role="alert" >' . validateSignupForm($_POST) . '</div>';
}
//for validating the signup form
function validateSigninForm($form_data)
{
    $s = '';
    if (!$form_data['username'])
        $s = 'user name is not given!';
    else if (!$form_data['password'])
        $s = 'password name is not given!';
    else if (!isSignin($form_data['username'], $form_data['password']))
        $s = 'username or password is incorrect!';
    return $s;
}
function showValidateSigninForm()
{
    if ($_POST)
        echo '<div class="alert alert-danger my-2" role="alert" >' . validateSigninForm($_POST) . '</div>';
}
//for validating the signup form
function validateForgotPasswordForm($form_data)
{
    $s = '';
    if (!$form_data['email'])
        $s = 'enter your email id!';
    else if (!isEmailRegistered($form_data['email']))
        $s = 'email id is not registered!';
    return $s;
}
function showValidateForgotPasswordForm()
{
    if ($_POST)
        echo '<div class="alert alert-danger my-2" role="alert" >' . validateForgotPasswordForm($_POST) . '</div>';
}
//for validating the verity email form
function isVerifyEmail($code)
{
    if ($code != $_SESSION['resendcode'])
        return false;
    return true;
}

function validateVerifyEmailForm($form_data)
{
    $s = '';
    if (!$form_data['code'])
        $s = 'enter digit code id!';
    else if (!isVerifyEmail($form_data['code']))
        $s = 'digit code is incorrect!';
    return $s;
}
function showValidateVerifyEmailForm()
{
    if ($_POST)
        echo '<div class="alert alert-danger my-2" role="alert" >' . validateVerifyEmailForm($_POST) . '</div>';
}
//for validating the reset password
function validateResetPasswordForm($form_data)
{
    $s = '';
    if (!$form_data['password'])
        $s = 'enter new password!';
    return $s;
}
function showValidateResetPasswordForm()
{
    if ($_POST)
        echo '<div class="alert alert-danger my-2" role="alert" >' . validateResetPasswordForm($_POST) . '</div>';
}

//for validating the update profile
// function isPostFileImage($image_data)
// {
//     $s='';
//     $file_name = $image_data['name'];
//     $file_size = $image_data['size'];
//     $file_tmp = $image_data['tmp_name'];
//     $file_parts =explode('.',$file_name);
//     $file_ext=strtolower(end($file_parts));
//     $expensions= array("jpeg","jpg","png");
//     $target = "upload/".basename($file_name);
//     if(in_array($file_ext,$expensions)=== false){
//     $s= "Only JPEG or PNG files are supported.";
//     }
//     else if($file_size > 2097152) {
//         $s= 'File size should not be larger than 2MB';
//     }
//     return $s;
// }
function validateUpdateForm($form_data)
{
    $s = '';
    if (!$form_data['first_name'])
        $s = 'first name is not given!';
    else if (!$form_data['last_name'])
        $s = 'last name is not given!';
    else if (!$form_data['username'])
        $s = 'user name is not given!';
    else if (isUsernameRegisteredByOther($form_data['username'], $form_data['email']))
        $s = $form_data['username'] . ' is already registered!';
    return $s;
}
function showValidateUpdateForm($form_data)
{
    if ($_POST)
        echo '<div class="alert alert-danger my-2" role="alert" >' . validateUpdateForm($form_data) . '</div>';
}
//for post image update
function UpdateProfilePic($file, $user)
{
    $file_tmp = $file['tmp_name'];
    $image = $file['name'];
    $target = "upload/user$user->id/" . basename($image);
    unlink("upload/user$user->id/$user->profile_pic");
    move_uploaded_file($file_tmp, $target);
}


//for carousel show image post
//for Indicators/dots
// function Indicators_dots($collections, $post_id)
// {
//     if (count($collections) != 1) {
//         echo '<div class="carousel-indicators">';
//         foreach ($collections as $key => $value) {
//             if ($key == 0) {
//                 echo "<button type='button' data-bs-target='#demo$post_id' data-bs-slide-to='$key' class='active'></button>";
//             }
//             else {
//                 echo "<button type='button' data-bs-target='#demo$post_id' data-bs-slide-to='$key'></button>";
//             }
//         }
//         echo '</div>';
//     }
// }
//for The slideshow/carousel
function Theslideshow_carousel($collections, $user_id)
{
    echo '<div class="carousel-inner">';
    foreach ($collections as $key => $value) {
        if ($key == 0) {
            echo '<div class="carousel-item active">';
        } else {
            echo '<div class="carousel-item">';
        }
        if ($value->type == 1) {
            echo "<img src='/pictogram/upload/user$user_id/$value->file_name' alt='$value->file_name' class='d-block' style ='object-fit: contain;width: 100%;height: 600px;background-color: black;'>";
        } else {
            echo "<video controls class='d-block' src='/pictogram/upload/user$user_id/$value->file_name' style ='object-fit: contain;width: 100%;height: 600px;background-color: black;'>>
                <source  type='video/mp4'>
              </video>";
        }
        echo '</div>';
    }
    echo '</div>';
}
//for Left and right controls/icons 
function Leftandrightcontrols_icons($collections, $post_id, $target = 'demo')
{

    if (count($collections) != 1) {
        echo '<button class="carousel-control-prev" type="button" data-bs-target="#' . $target . $post_id . '" data-bs-slide="prev" style="width:50px;height:50px;margin-top:270px">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#'  . $target . $post_id . '" data-bs-slide="next" style="width:50px;height:50px;margin-top:270px">
        <span class="carousel-control-next-icon"></span>
    </button>';
    }
}

//for date create post
function createAtPost($createAt)
{
    $date1 = date_create(date('Y/m/d H:i:s'));
    $date2 = date_create("$createAt");
    $diff = date_diff($date1, $date2);
    if (date_format($date2, 'Y') != date('Y')) {
        return date_format($date2, 'F j, Y');
    }
    if ($diff->days > 1) {
        return date_format($date2, 'F j \a\t g:i A');
    } else if (0 < $diff->days && $diff->days < 2) {
        return date_format($date2, '\Y\e\s\t\e\r\d\a\y \a\t g:i A');
    } else if (0 < $diff->h && $diff->h < 24) {
        return $diff->h . 'h';
    } elseif (0 < $diff->i && $diff->i < 60) {
        return $diff->i . 'm';
    } elseif (0 <= $diff->s && $diff->s < 60) {
        return $diff->s . 's';
    }
}
function createAtNotification($createAt)
{
    $date1 = date_create(date('Y/m/d H:i:s'));
    $date2 = date_create("$createAt");
    $diff = date_diff($date1, $date2);
    $w = $diff->d / 7;
    if ($diff->y != 0) {
        return $diff->y == 1 ? 'a year ago' : $diff->y . ' years ago';
    } else if ($diff->m != 0) {
        return $diff->m == 1 ? 'a month ago' : $diff->m . ' months ago';
    } else if (1 <= $w) {
        return floor($w) == 1 ? 'a week ago' : floor($w) . ' weeks ago';
    } else if ($w > 0 && $w < 1) {
        return $diff->d == 1 ? 'a day ago' : $diff->d . ' days ago';
    } elseif (0 < $diff->h && $diff->h < 24) {
        return $diff->h == 1 ? 'about an hour ago' : $diff->h . ' hours ago';
    } elseif (0 < $diff->i && $diff->i < 60) {
        return $diff->i == 1 ? 'about an minute ago' : $diff->i . ' minutes ago';
    } elseif (0 < $diff->s && $diff->s < 60) {
        return 'less than a minute ago';
    }
}
function createAtComment($createAt)
{
    $date1 = date_create(date('Y/m/d H:i:s'));
    $date2 = date_create("$createAt");
    $diff = date_diff($date1, $date2);
    $w = $diff->d / 7;
    if ($diff->y != 0) {
        return $diff->y . 'y';
    } else if ($diff->m != 0) {
        return $diff->m . 'm';
    } else if (1 <= $w) {
        return floor($w) . 'w';
    } else if ($w > 0 && $w < 1) {
        return $diff->d . 'd';
    } elseif (0 < $diff->h && $diff->h < 24) {
        return $diff->h . 'h';
    } elseif (0 < $diff->i && $diff->i < 60) {
        return $diff->i . 'm';
    } elseif (0 <= $diff->s && $diff->s < 60) {
        return $diff->s . 's';
    }
}
function createAtMessage($createAt)
{
    $date1 = date_create(date('Y/m/d H:i:s'));
    $date2 = date_create($createAt);
    $diff = date_diff($date1, $date2);
    if (date_format($date2, 'Y') != date('Y')) {
        return date_format($date2, 'F j, Y');
    }
    if ($diff->days > 1) {
        return date_format($date2, 'g:i A \| F j');
    } else if (0 < $diff->days && $diff->days < 2) {
        return date_format($date2, '\Y\e\s\t\e\r\d\a\y');
    } else if (0 < $diff->h && $diff->h < 24) {
        return $diff->h . 'h';
    } elseif (0 < $diff->i && $diff->i < 60) {
        return $diff->i . 'm';
    } elseif (0 <= $diff->s && $diff->s < 60) {
        return $diff->s . 's';
    }
}
function createAtChat_title($createAt){
    $createAt = date_create($createAt);
    return date_format($createAt, 'F j, Y');
}
function createAtChat($createAt){
    $createAt = date_create($createAt);
    return date_format($createAt, 'G:i');
}

//for get number of posts
function numberOfPosts($user_id)
{
    global $db;
    $query = "select count(*) as 'number' from posts where user_id='$user_id'";
    return $db->getRow($query)['number'];
}
//for get number of followers
function numberOfFollowers($user_id)
{
    global $db;
    $query = "select count(*) as 'number' from follow_list where user_id='$user_id'";
    return $db->getRow($query)['number'];
}
//for get number of following
function numberOfFollowing($user_id)
{
    global $db;
    $query = "select count(*) as 'number' from follow_list where follower_id='$user_id'";
    return $db->getRow($query)['number'];
}
//for check follow status
function FollowStatus($user_id, $follower_id)
{
    global $db;
    $query = "select *  from follow_list where follower_id='$follower_id' and user_id = '$user_id'";
    if ($db->getRow($query)) {
        echo " <button class='btn btn-sm btn-danger' onclick='Unfollow(event.currentTarget,$user_id)' >Unfollow</button> ";
    } else {
        echo "<button class='btn btn-sm btn-primary' onclick='Follow(event.currentTarget,$user_id)' >Follow</button>";
    }
}
//for check like status
function LikeStatus($user_id, $post_id)
{
    global $db;
    $query = "select *  from likes where post_id='$post_id' and user_id = '$user_id'";
    if ($db->getRow($query)) {
        echo "<i class='bi bi-heart-fill like_btn' data-post-id='$post_id' style='color:red'></i>";
    } else {
        echo "<i class='bi bi-heart like_btn' data-post-id='$post_id'></i>";
    }
}
//for get number of likes
function numberOfLikes($post_id)
{
    global $db;
    $query = "select count(*) as 'number' from likes where post_id='$post_id'";
    return $db->getRow($query)['number'];
}
//for get number of comments
function numberOfComments($post_id)
{
    global $db;
    $query = "select count(*) as 'number' from comments where post_id='$post_id'";
    return $db->getRow($query)['number'];
}
//for get all comments
function getAllComments($post_id, $most_recent = 0)
{
    global $db;
    $query = "Select b.user_id,a.first_name,a.last_name,a.username,a.profile_pic,b.id as 'comment_id',b.comment,b.post_id,c.user_id as 'post_user',b.created_at from users a,comments b,posts c where a.id = b.user_id and b.post_id = $post_id and  b.post_id = c.id ";
    if ($most_recent) {
        $query .= 'order by b.id desc limit 2';
    }
    return $db->getAllData($query);
}
function ShowMostRecentComments($post_id)
{
    $mostRecentComments = getAllComments($post_id, 1);
    usort($mostRecentComments, function ($a, $b) {
        return $a->comment_id > $b->comment_id;
    });
    foreach ($mostRecentComments as $key => $value) {
        echo "<span class='p-1 mx-2'><span style='font-weight:bold' title='$value->username' >$value->first_name $value->last_name</span><span title='$value->created_at' class='text-muted'> $value->comment</span> </span>";
    }
}
function ShowAllComments($post_id)
{
    $comments = getAllComments($post_id);
    foreach ($comments as $key => $value) {
        echo "<span class='p-1 mx-2' title='$value->created_at'><span style='font-weight:bold' title='$value->username' >$value->first_name $value->last_name</span> $value->comment </span>";
    }
}
//for searching the users
function searchUser($keyword)
{
    global $db;
    $query = "SELECT * FROM users WHERE username LIKE '%" . $keyword . "%' || (first_name LIKE '%" . $keyword . "%' || last_name LIKE '%" . $keyword . "%') LIMIT 5";
    return $db->getAllData($query);
}
//for checking the user is blocked by current user or user
function checkBlockStatusByUser($user_id, $user_found)
{
    global $db;
    $query = "SELECT count(*) as 'number' FROM block_list WHERE user_id=$user_id && blocked_user_id=$user_found";
    return $db->getRow($query)['number'];
}

function checkBlockStatusByUserAndUserFound($user_id, $user_found)
{
    global $db;
    $query = "SELECT count(*) as 'number' FROM block_list WHERE (user_id=$user_found && blocked_user_id=$user_id) || (user_id=$user_id && blocked_user_id=$user_found)";
    return $db->getRow($query)['number'];
}

//for checking user_current comments notification 
function checkUserPost($post_id, $user_id)
{
    global $db;
    $query = "SELECT COUNT(*) AS 'number' FROM posts WHERE id = $post_id and user_id = $user_id";
    return $db->getRow($query)['number'];
}
//for get number of Unread Notifications
function numberOfUnreadNotifications($user_id)
{
    global $db;
    $query = "SELECT COUNT(*) AS 'number' FROM notifications WHERE to_user_id = $user_id and read_status = 0";
    return $db->getRow($query)['number'];
}

//get message of user_id
function getMessages($from_user_id, $to_user_id,$unread = 0)
{
    global $db;
    $query = "SELECT * FROM messages WHERE ((to_user_id=$from_user_id && from_user_id=$to_user_id) || (from_user_id=$from_user_id && to_user_id=$to_user_id)) ";
    if($unread) $query.='AND read_status = 0';
    return  $db->getAllData($query);
}
//for information user
function getUser($user_id)
{
    global $db;
    return (object)$db->getRow('select id,username,first_name,last_name,profile_pic from users where id = ' . $user_id);
}

//for getting ids of chat users
function getActiveChatUserIds($user_id)
{
    global $db;
    $query = "SELECT from_user_id,to_user_id FROM messages WHERE from_user_id=$user_id || to_user_id = $user_id ORDER BY ID DESC";
    $data = $db->getAllData($query);
    $ids = array();
    foreach ($data as $ch) {
        if ($ch->from_user_id != $user_id && !in_array($ch->from_user_id, $ids) && !isCheckMessageRequests($ch->from_user_id,$user_id) ) {
            $ids[] = $ch->from_user_id;
        }
        if ($ch->to_user_id != $user_id && !in_array($ch->to_user_id, $ids)) {
            $ids[] = $ch->to_user_id;
        }
    }
    return $ids;
}
function getActiveChatUsers($user_id)
{
    global $db;
    $active_chat = getActiveChatUserIds($user_id);
    $data = array();
    foreach ($active_chat as $key => $value) {
        $data[$key]['user'] = getUser($value);
        $data[$key]['blocked'] = checkBlockStatusByUserAndUserFound($user_id,$value)?true:false;
        $data[$key]['message'] = (object)$db->getRow("SELECT from_user_id,msg,created_at FROM messages WHERE (to_user_id=$value && from_user_id=$user_id) || (from_user_id=$value && to_user_id=$user_id) ORDER BY id DESC LIMIT 1");
        $data[$key]['message']->from_user_id = $data[$key]['message']->from_user_id != $user_id ? "@{$data[$key]['user']->username}" : 'You';
        $data[$key]['unread'] = $db->getRow("SELECT COUNT(*) AS 'number' FROM messages WHERE from_user_id=$value && to_user_id=$user_id  and read_status = 0")['number'];
    }
    return $data;
}
//for search messengers
function getActiveChatMessengers($user_id)
{
    global $db;
    $active_chat = getActiveChatUserIds($user_id);
    $following = $db->getAllData("Select user_id from follow_list where follower_id = $user_id"); 
    $data = array();
    foreach ($following as $key => $value) {
        if(!in_array($value->user_id,$active_chat))
        $active_chat[] = $value->user_id;
    }
    foreach ($active_chat as $key => $value) {
        $data[$key]['user'] = getUser($value);
        $data[$key]['blocked'] = checkBlockStatusByUserAndUserFound($user_id,$value)?true:false;
        $data[$key]['message'] = (object)$db->getRow("SELECT from_user_id,msg,created_at FROM messages WHERE (to_user_id=$value && from_user_id=$user_id) || (from_user_id=$value && to_user_id=$user_id) ORDER BY id DESC LIMIT 1");
        if((array)$data[$key]['message']){
        $data[$key]['message']->from_user_id = $data[$key]['message']->from_user_id != $user_id ? "@{$data[$key]['user']->username}" : 'You';
        $data[$key]['unread'] = $db->getRow("SELECT COUNT(*) AS 'number' FROM messages WHERE from_user_id=$value && to_user_id=$user_id  and read_status = 0")['number'];
    }
    }
    return $data;
}
//for get number of Unread Messages
function numberOfUnreadMessages($user_id)
{
    global $db;
    $query = "SELECT COUNT(DISTINCT from_user_id) AS 'number' FROM messages WHERE to_user_id = $user_id and read_status = 0 and request=0";
    return $db->getRow($query)['number'];
}

//for get message request
function isCheckMessageRequests($from_user_id,$to_user_id,$request = true){
    global $db;
    $query = "SELECT count(*) as 'number' from messages where from_user_id =$from_user_id and to_user_id = $to_user_id ";
    if($request) $query.= 'and request = 1';
    else $query.= 'and request = 0';
    return $db->getRow($query)['number'];
}
function getActiveChatUserIdsRequest($user_id)
{
    global $db;
    $query = "SELECT from_user_id,to_user_id FROM messages WHERE  to_user_id = $user_id and request = 1 ORDER BY ID DESC";
    $data = $db->getAllData($query);
    $ids = array();
    foreach ($data as $ch) {
        if ($ch->from_user_id != $user_id && !in_array($ch->from_user_id, $ids) ) {
            $ids[] = $ch->from_user_id;
        }
    }
    return $ids;
}
function getActiveChatUsersRequest($user_id)
{
    global $db;
    $active_chat = getActiveChatUserIdsRequest($user_id);
    $data = array();
    foreach ($active_chat as $key => $value) {
        $data[$key]['user'] = getUser($value);
        $data[$key]['blocked'] = checkBlockStatusByUserAndUserFound($user_id,$value)?true:false;
        $data[$key]['message'] = (object)$db->getRow("SELECT from_user_id,msg,created_at FROM messages WHERE from_user_id=$value && to_user_id=$user_id and request = 1 ORDER BY id DESC LIMIT 1");
        $data[$key]['message']->from_user_id =  "@{$data[$key]['user']->username}";
        $data[$key]['unread'] = $db->getRow("SELECT COUNT(*) AS 'number' FROM messages WHERE from_user_id=$value && to_user_id=$user_id  and read_status = 0 and request = 1")['number'];
    }
    return $data;
}
function isCheckFollower($follower_id,$user_id){
    global $db;
    $query = "SELECT count(*) as 'number' from follow_list where follower_id =$follower_id and user_id = $user_id";
    return $db->getRow($query)['number'];
}
//for get number of Unread Messages Request
function numberOfUnreadMessagesRequest($user_id)
{
    global $db;
    $query = "SELECT COUNT(DISTINCT from_user_id) AS 'number' FROM messages WHERE to_user_id = $user_id and read_status = 0 and request=1";
    return $db->getRow($query)['number'];
}

//for checking swearing when posts
function isCheckSwearing($s){
    $s=mb_strtoupper($s, 'UTF-8');
    $swearing = ['ĐCM','ĐỊT','FUCK','DICK','PUSSY','LỒN','BUỒI','CỨT'];
    foreach ($swearing as $key => $value) {
        if(strpos($s, $value) !== false) return true;
    }
    return false;
}






