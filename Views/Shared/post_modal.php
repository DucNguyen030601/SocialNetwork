<?php
$postUser = $models[0];
$collections = $models[1];
$comments = $models[2];
$user_id = $_SESSION[User::TABLE]['id'];
$checkCollections = count($collections) > 0 ? true : false;
?>
<div class="modal-dialog  modal-dialog-centered <?= $checkCollections ? 'modal-xl' : '' ?>">
    <div class="modal-content">
        <div class="modal-body d-flex p-0">
            
            <?php if ($checkCollections) { ?>
                <div class="col-8">
                    <div id="demo_modal_<?= $postUser->post_id ?>" class="carousel slide" data-bs-ride="carousel">
                        <?= Theslideshow_carousel($collections, $postUser->user_id) ?>
                        <?= Leftandrightcontrols_icons($collections, $postUser->post_id, 'demo_modal_') ?>
                    </div>
                </div>
            <?php } ?>


            <div class="d-flex flex-column <?= $checkCollections ? 'col-4' : 'container' ?>  ">
                <div class="d-flex align-items-center p-2  ">
                    <div><img src="/pictogram/upload/user<?= $postUser->user_id . '/' . $postUser->profile_pic ?>" alt="" style="object-fit:cover" height="55" width="55" class="rounded-circle border">
                    </div>
                    <div>&nbsp;&nbsp;&nbsp;</div>
                    <div class="d-flex flex-column justify-content-start align-items-center">
                        <a href="/pictogram/account?user=<?= $postUser->username ?>" class="text-decoration-none text-dark">

                            <h6 style="margin: 0px;">
                                <?= $postUser->first_name . ' ' . $postUser->last_name ?>
                            </h6>
                        </a>
                        <p style="margin:0px;" class="text-muted">@<?= $postUser->username ?>
                        </p>
                    </div>

                </div>
                <div class="d-flex align-items-center  p-1 mx-2 border-bottom">
                    <?= $postUser->post_text ?>
                </div>
                <div class="flex-fill align-self-stretch overflow-auto" id="show-comments-modal-<?= $postUser->post_id ?>" style="height: 400px;">
                    <?php if (count($comments) == 0) echo '<p class="p-2 mx-2 bg-white border rounded text-center">Be The First To Comment</p>';
                    else {
                        foreach ($comments as $key => $value) { ?>
                            <div class="d-flex align-items-center p-2" style="position:relative" id="comment_show_id_<?= $value->comment_id ?>">
                                <div><img src="/pictogram/upload/user<?= $value->user_id . '/' . $value->profile_pic ?>" alt="" style="object-fit:cover" height="50" width="50" class="rounded-circle border"></div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <a href="/pictogram/account?user=<?= $value->username ?>" class="text-decoration-none text-dark">
                                        <h6 style=" margin: 0px;"> <?= $value->first_name . ' ' . $value->last_name ?> <span style="font-size:x-small;font-weight:lighter" title="<?= $value->created_at ?>"><?= createAtComment($value->created_at) ?></span></h6>
                                    </a>
                                    <div class="dropdown" style="position:absolute;right:0.5em">
                                        <span type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <?php if ($value->user_id == $user_id || $value->post_user == $user_id) { ?>
                                                <li onclick="DeleteComment('<?= $value->comment_id ?>',<?= $postUser->post_id ?>)"><a class="dropdown-item"><i class="bi bi-trash-fill"></i> Delete</a></li><?php } ?>
                                                <?php if ($value->user_id != $user_id) { ?>
                                            <li onclick="AddReport(2,<?=$value->user_id?>,<?=$value->comment_id?>)"><a class="dropdown-item"><i class="bi bi-exclamation-diamond-fill"></i> Report</a></li><?php } ?>
                                        </ul>
                                    </div>
                                    <p style="margin:0px;" class="text-muted"><?= $value->comment ?></p>

                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
                <div class="input-group p-2 border-top">
                    <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary rounded-0 border-0" type="button" id="button-addon2" onclick="AddComment(event.currentTarget,'<?= $postUser->post_id ?>')">Post</button>
                </div>
            </div>
        </div>
    </div>
</div>