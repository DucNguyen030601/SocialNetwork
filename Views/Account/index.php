<?php global $db;
$posts = $models[1];
$userFound = $models[0];
$collections = $models[2];
$user = $models[3];
$followers = $models[4];
$following = $models[5];
?>
<?= showPage('header', ['page_title' => 'Profile']) ?>
<?= showPage('nav', $user) ?>

<div class="container col-9 rounded-0">
    <div class="col-12 rounded p-4 mt-4 d-flex gap-5">
        <div class="col-4 d-flex justify-content-end align-items-start"><img src="/pictogram/upload/<?php echo "user$userFound->id/" . $userFound->profile_pic ?>" class="img-thumbnail rounded-circle my-3" style="height:170px;width:170px;object-fit:cover" alt="avatar">
        </div>
        <div class="col-8">
            <div class="d-flex flex-column">
                <div class="d-flex gap-5 align-items-center">
                    <span style="font-size: xx-large;">
                        <?= $userFound->first_name . ' ' . $userFound->last_name ?>
                    </span>
                    <?php if ($userFound->id != $user->id && !checkBlockStatusByUserAndUserFound($user->id, $userFound->id)) { ?>
                        <div class="dropdown">
                            <span class="" style="font-size:xx-large" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li data-bs-toggle="modal" data-bs-target="#send_message"><a class="dropdown-item"><i class="bi bi-chat-fill"></i> Message</a></li>
                                <li onclick="Block(<?= $userFound->id ?>)"><a class="dropdown-item"><i class="bi bi-x-circle-fill"></i> Block</a></li>
                                <li onclick="AddReport(0,<?= $userFound->id ?>)"><a class="dropdown-item"><i class="bi bi-exclamation-diamond-fill"></i> Report</a></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
                <span style="font-size: larger;" class="text-secondary">@<?= $userFound->username ?>
                </span>
                <?php if (!checkBlockStatusByUserAndUserFound($user->id, $userFound->id)) { ?>
                    <div class="d-flex gap-2 align-items-center my-3">

                        <a class="btn btn-sm btn-primary"><i class="bi bi-file-post-fill"></i>
                            <?= numberOfPosts($userFound->id) ?> Posts
                        </a>
                        <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#follower_list"><i class="bi bi-people-fill"></i>
                            <?= numberOfFollowers($userFound->id) ?> Followers
                        </a>
                        <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#following"><i class="bi bi-person-fill"></i>
                            <?= numberOfFollowing($userFound->id) ?> Following
                        </a>

                    </div>
                <?php } ?>

                <?php if ($userFound->id != $user->id) { ?>
                    <div class="d-flex gap-2 align-items-center my-1">
                        <?php if (checkBlockStatusByUser($user->id, $userFound->id)) { ?>
                            <button class="btn btn-sm btn-danger unblockbtn" onclick="UnBlock(<?= $userFound->id ?>)">Unblock</button>
                        <?php } else if (checkBlockStatusByUser($userFound->id, $user->id)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="bi bi-x-octagon-fill"></i>
                                <?= $userFound->first_name . ' ' . $userFound->last_name ?> blocked you !
                            </div>
                        <?php } else {
                            FollowStatus($userFound->id, $user->id) ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if (checkBlockStatusByUserAndUserFound($user->id, $userFound->id)) { ?>
        <div class="alert alert-secondary text-center" role="alert">
            <i class="bi bi-x-octagon-fill"></i> You are not allowed to see posts !
        </div>
    <?php } else { ?>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#home"><i class="far fa-newspaper"></i> Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#collections"><i class="fas fa-photo-video"></i>
                    Collections</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div id="home" class="container tab-pane active"><br>
                <h3>POSTS</h3>
                <p>Posts created by
                    <?php $name = $user->id != $userFound->id ? $userFound->first_name . ' ' . $userFound->last_name : 'you';
                    echo $name ?> will appear below.
                </p>
                <?php if (count($posts) == 0) {
                    echo "<p class='p-2 bg-white border rounded text-center my-3'>$name don't have any post</p>";
                }
                foreach ($posts as $key => $value) { ?>
                    <div class="card mt-4">
                        <div class="card-title d-flex justify-content-between  align-items-center">
                            <div class="d-flex align-items-center p-2">
                                <img src="upload/user<?= $value->user_id . '/' . $value->profile_pic ?>" alt="" style="object-fit:cover" height="40" width="40" class="rounded-circle border">
                                &nbsp;&nbsp;
                                <span style="font-weight:600;margin-top:-20px">
                                    <?= $value->first_name . ' ' . $value->last_name ?>
                                </span>
                            </div>
                            <div class="p-2">
                            <div class="dropdown">
                            <span type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="/pictogram/post?post_id=<?= $value->post_id ?>"><i class="fas fa-external-link-alt"></i> Go to the post</a></li>
                                    <?php if ($userFound->id == $user->id) { ?>
                                    <li onclick="DeletePost('<?= $value->post_id ?>')"><a class="dropdown-item"><i class="bi bi-trash-fill"></i> Delete</a></li>
                                    <?php } else{?>
                                    <li onclick="AddReport(1,<?=$userFound->id?>,<?=$value->post_id?>)"><a class="dropdown-item" ><i class="bi bi-exclamation-diamond-fill"></i> Report</a></li><?php } ?>
                            </ul>
                        </div>
                            </div>
                        </div>
                        <span style="display:block;margin-top: -35px;margin-left: 57px;font-size:small;font-weight:lighter" title="<?= $value->created_at ?>">
                            <?= createAtPost($value->created_at) ?> . <i class='fas'>&#xf57d;</i>
                        </span>

                        <?php $collection = $db->Where(['post_id' => $value->post_id], [Collection::TABLE]);
                        if (count($collection) != 0) { ?>
                            <div id="demo<?= $value->post_id ?>" class="carousel slide" style="padding-top:0.5rem!important;" data-bs-ride="carousel">
                                <?= Theslideshow_carousel($collection, $value->user_id) ?>
                                <?= Leftandrightcontrols_icons($collection, $value->post_id) ?>
                            </div>
                        <?php } ?>

                        <h4 style="font-size: x-larger" class="p-2 border-bottom">
                            <?= LikeStatus($user->id, $value->post_id) ?>&nbsp;&nbsp;<i class="bi bi-chat-left show-post-modal" data-bs-toggle="modal" data-bs-target="#postModal" data-post-id="<?= $value->post_id ?>"></i>
                        </h4>
                        <span class="p-1 mx-2 show-like-modal" style="font-weight:bold;" data-bs-toggle="modal" data-bs-target="#likeModal" data-post-id="<?= $value->post_id ?>"><span id="number-of-likes-<?= $value->post_id ?>">
                                <?= numberOfLikes($value->post_id) ?>
                            </span> likes</span>
                        <?php if ($value->post_text) { ?>
                            <span class="p-1 mx-2"><span style="font-weight:bold">
                                    <?= $value->first_name . ' ' . $value->last_name ?>
                                </span>
                                <?= $value->post_text ?>
                            </span>
                        <?php } ?>

                        <span class="p-1 mx-2 card-body show-post-modal" id="number-of-comments-<?= $value->post_id ?>" data-bs-toggle="modal" data-bs-target="#postModal" data-post-id="<?= $value->post_id ?>" style="font-weight:lighter;display:<?= numberOfComments($value->post_id) ? 'block' : 'none' ?>">Views
                            all
                            <?= numberOfComments($value->post_id) ?> comments
                        </span>

                        <?= ShowMostRecentComments($value->post_id) ?>
                        <div id='show-upload-comment-<?= $value->post_id ?>' class="p-1 mx-2"></div>
                        <div class="input-group p-2">
                            <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="Say something.." aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary rounded-0 border-0" type="button" id="button-addon2" onclick="AddComment(event.currentTarget,'<?= $value->post_id ?>')">Post</button>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div id="collections" class="container tab-pane fade"><br>
                <h3>Collection</h3>
                <p>
                    <?= $user->id != $userFound->id ? $userFound->first_name . " " . $userFound->last_name . "'s " : 'Your' ?>
                    video images that have been posted with the article will appear directly below.
                </p>
                <div class="gallery d-flex flex-wrap justify-content-center gap-2 mb-4">
                    <?php foreach ($collections as $key => $value) {
                        if ($value->type == 1) { ?>
                            <img src="upload/user<?= $userFound->id . "/{$value->file_name}" ?>" width="400px" height="300px" style="object-fit:cover" class="rounded my-collections" alt="<?= $value->post_text ?>" title="image" />
                        <?php } else { ?>
                            <video width="400px" height="300px" style="object-fit:cover;" class="rounded my-collections" alt="<?= $value->post_text ?>" src="/pictogram/upload/user<?= $userFound->id . "/{$value->file_name}" ?>" title="video">
                            </video>
                    <?php }
                    } ?>
                </div>
            </div>

        </div>
        <!-- this is for follower list -->
        <div class="modal fade" id="follower_list" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title">Followers</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php foreach ($followers as $key => $value) { ?>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center p-2">
                                    <div><img src="upload/user<?= $value->id . '/' . $value->profile_pic ?>" alt="" height="40" width="40" style="object-fit:cover" class="rounded-circle border">
                                    </div>
                                    <div>&nbsp;&nbsp;</div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="/pictogram/account?user=<?= $value->username ?>" class="text-decoration-none text-dark">
                                            <h6 style="margin: 0px;font-size: small;">
                                                <?= $value->first_name . ' ' . $value->last_name ?>
                                            </h6>
                                        </a>
                                        <p style="margin:0px;font-size:small" class="text-muted">@<?= $value->username ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <?php if ($value->id != $user->id) FollowStatus($value->id, $user->id) ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- this is for following list -->
        <div class="modal fade" id="following" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title">Following</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php foreach ($following as $key => $value) { ?>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center p-2">
                                    <div><img src="upload/user<?= $value->id . '/' . $value->profile_pic ?>" alt="" height="40" width="40" style="object-fit:cover" class="rounded-circle border">
                                    </div>
                                    <div>&nbsp;&nbsp;</div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="/pictogram/account?user=<?= $value->username ?>" class="text-decoration-none text-dark">
                                            <h6 style="margin: 0px;font-size: small;">
                                                <?= $value->first_name . ' ' . $value->last_name ?>
                                            </h6>
                                        </a>
                                        <p style="margin:0px;font-size:small" class="text-muted">@<?= $value->username ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <?php if ($value->id != $user->id) FollowStatus($value->id, $user->id) ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- this is for open collections -->
        <div id="myModalCollections" class="modal-collections">
            <span class="close-modal-collections">&times;</span>
            <img id="myImage" class="modal-content-collections" style="display:none;">
            <video id="myVideo" class="modal-content-collections" autoplay controls style="display:none;max-width: 92%;"></video>
            <div id="caption-modal-collections"></div>
        </div>
        <!-- this is for send message -->
        <div class="modal fade" id="send_message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New message to <?= $userFound->first_name . ' ' . $userFound->last_name ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label class="col-form-label">Recipient:</label>
                                <input type="text" class="form-control" disabled value="<?= $userFound->first_name . ' ' . $userFound->last_name ?> - @<?= $userFound->username ?>">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Message:</label>
                                <textarea class="form-control message-input"></textarea>
                                <hr>
                                <button type="button" class="btn btn-primary " onclick="AddMessage(event.currentTarget,'<?= $userFound->id ?>',1)">Send message <i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>




<?= showPage('footer') ?>
<script>
    // Get the modal
    var modal = $("#myModalCollections");
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var col = $(".my-collections");
    var modalImg = $("#myImage");
    var modalVideo = $("#myVideo");
    var captionText = $("#caption-modal-collections");
    var type = 0;
    col.click(function() {
        modal.show();
        if ($(this).attr('title') == 'image') {
            type = 0;
            modalImg.show();
            modalImg.attr('src', $(this).attr('src'));
        } else {
            type = 1;
            modalVideo.attr('src', $(this).attr('src'));
            modalVideo.show();
        }
        captionText.html($(this).attr('alt'));
    })

    // Get the <span> element that closes the modal
    var span = $(".close-modal-collections");
    // When the user clicks on <span> (x), close the modal
    span.click(() => {
        modal.hide()
        if (type) {
            modalVideo.attr('src', '');
            modalVideo.hide();
        } else modalImg.hide();
    })
    $("#send_message").on('shown.bs.modal', function() {
        $(this).find('textarea').focus();
    });
</script>