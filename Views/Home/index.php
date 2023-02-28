<?php global $db;
$user = $models[0];
$otherUsers = $models[1];
$postUsers = $models[2]; ?>
<?= showPage('header', ['page_title' => 'Pictogram']) ?>
<?= showPage('nav', $user) ?>
<div class="container col-9 rounded-0 d-flex justify-content-between">
    <div class="col-8">
        <?php if (count($postUsers) == 0) echo '<p class="p-2 bg-white border rounded text-center my-3">Follow Someone or Add a new post</p>';
        else
            foreach ($postUsers as $key => $values) { ?>
            <div class="card mt-4">
                <div class="card-title d-flex justify-content-between  align-items-center">
                    <a href="/pictogram/account?user=<?= $values->username ?>" class="text-decoration-none text-dark">
                    <div class="d-flex align-items-center p-2">
                        <img src="upload/user<?= $values->user_id . '/' . $values->profile_pic ?>" alt="" style="object-fit:cover" height="40" width="40" class="rounded-circle border">
                        &nbsp;&nbsp;
                        
                            <span style="font-weight:600;margin-top:-20px"><?= $values->first_name . ' ' . $values->last_name ?></span> 
                      
                    </div></a>
                    <div class="p-2">
                        <div class="dropdown">
                            <span type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="/pictogram/post?post_id=<?= $values->post_id ?>"><i class="fas fa-external-link-alt"></i> Go to the post</a></li>
                                    <?php if ($values->user_id == $user->id) { ?>
                                    <li onclick="DeletePost('<?= $values->post_id ?>')"><a class="dropdown-item"><i class="bi bi-trash-fill"></i> Delete</a></li>
                                    <?php } else{?>
                                    <li onclick="AddReport(1,<?=$values->user_id?>,<?=$values->post_id?>)"><a class="dropdown-item" ><i class="bi bi-exclamation-diamond-fill"></i> Report</a></li><?php } ?>
                            </ul>
                        </div>
                    </div>

                </div>
                <span style="margin-top: -35px;margin-left: 57px;font-size:small" class="text-muted" title="<?= $values->created_at ?>"><?= createAtPost($values->created_at) ?> . <i class='fas'>&#xf57d;</i></span>

                <?php $collections = $db->Where(['post_id' => $values->post_id], [Collection::TABLE]);
                if (count($collections) != 0) { ?>
                    <div id="demo<?= $values->post_id ?>" class="carousel slide" style="padding-top:0.5rem!important;" data-bs-ride="carousel">
                        <?= Theslideshow_carousel($collections, $values->user_id) ?>
                        <?= Leftandrightcontrols_icons($collections, $values->post_id) ?>
                    </div>
                <?php } ?>

                <h4 style="font-size: x-larger" class="p-2 border-bottom"><?= LikeStatus($user->id, $values->post_id) ?>&nbsp;&nbsp;<i class="bi bi-chat-left show-post-modal" data-bs-toggle="modal" data-bs-target="#postModal" data-post-id="<?= $values->post_id ?>"></i>
                </h4>
                <span class="p-1 mx-2 show-like-modal" style="font-weight:bold;" data-bs-toggle="modal" data-bs-target="#likeModal" data-post-id="<?= $values->post_id ?>"><span id="number-of-likes-<?= $values->post_id ?>"><?= numberOfLikes($values->post_id) ?></span> likes</span>
                <?php if ($values->post_text) { ?>
                    <span class="p-1 mx-2"><span style="font-weight:bold"><?= $values->first_name . ' ' . $values->last_name ?></span> <?= $values->post_text ?></span>
                <?php } ?>

                <span class="p-1 mx-2 card-body show-post-modal" id="number-of-comments-<?= $values->post_id ?>" data-bs-toggle="modal" data-bs-target="#postModal" data-post-id="<?= $values->post_id ?>" style="font-weight:lighter;display:<?= numberOfComments($values->post_id) ? 'block' : 'none' ?>">Views all <?= numberOfComments($values->post_id) ?> comments</span>

                <?= ShowMostRecentComments($values->post_id) ?>
                <div id='show-upload-comment-<?= $values->post_id ?>' class="p-1 mx-2"></div>
                <div class="input-group p-2">
                    <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="Say something.." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary rounded-0 border-0" type="button" id="button-addon2" onclick="AddComment(event.currentTarget,'<?= $values->post_id ?>')">Post</button>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="col-4 mt-4 p-3">
        <div class="d-flex align-items-center p-2">
            <div><img src="upload/user<?= $user->id . '/' . $user->profile_pic ?>" alt="" height="60" width="60" style="object-fit:cover" class="rounded-circle border">
            </div>
            <div>&nbsp;&nbsp;&nbsp;</div>
            <div class="d-flex flex-column justify-content-center align-items-center">
                <h6 style="margin: 0px;"><?= $user->first_name . ' ' . $user->last_name ?></h6>
                <p style="margin:0px;" class="text-muted">@<?= $user->username ?></p>
            </div>
        </div>
        <div>
            <h6 class="text-muted p-2">You Can Follow Them</h6>
            <?php if (count($otherUsers) == 0) echo '<p class="p-2 bg-white border rounded text-center">No Sugesstions For You</p>';
            else
                foreach ($otherUsers as $key => $values) {
                    if (!checkBlockStatusByUserAndUserFound($user->id, $values->id)) { ?>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center p-2">
                            <div><img src="upload/user<?= $values->id . '/' . $values->profile_pic ?>" alt="" height="40" width="40" style="object-fit:cover" class="rounded-circle border">
                            </div>
                            <div>&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-center">
                                <a href="/pictogram/account?user=<?= $values->username ?>" class="text-decoration-none text-dark">
                                    <h6 style="margin: 0px;font-size: small;"><?= $values->first_name . ' ' . $values->last_name ?></h6>
                                </a>
                                <p style="margin:0px;font-size:small" class="text-muted">@<?= $values->username ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-primary" onclick="Follow(event.currentTarget,<?= $values->id ?>)">Follow</button>
                        </div>
                    </div>
            <?php }
                } ?>

        </div>
    </div>
</div>
<?= showPage('footer', ['page_title' => 'Sign Up']) ?>