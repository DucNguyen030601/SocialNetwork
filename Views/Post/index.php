<?php 
global $db;
$user = (object)$_SESSION[User::TABLE]?>
<?= showPage('header', ['page_title' => 'Edit Profile']) ?>
<?= showPage('nav', $user) ?>
<div class="container col-9 rounded-0">
    <div class="card mt-4">
        <div class="card-title d-flex justify-content-between  align-items-center">
            <div class="d-flex align-items-center p-2">
                <img src="upload/user<?= $model->user_id . '/' . $model->profile_pic ?>" alt="" style="object-fit:cover" height="40" width="40" class="rounded-circle border">
                &nbsp;&nbsp;
                <span style="font-weight:600;margin-top:-20px"><?= $model->first_name . ' ' . $model->last_name ?></span>
            </div>
            <div class="p-2">
            <div class="p-2">
                        <div class="dropdown">
                            <span type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php if ($model->user_id == $user->id) { ?>
                                    <li onclick="DeletePost('<?= $model->post_id ?>')"><a class="dropdown-item"><i class="bi bi-trash-fill"></i> Delete</a></li>
                                    <?php } else{?>
                                    <li onclick="Report(1,<?=$model->post_id?>,<?=$model->user_id?>)"><a class="dropdown-item" ><i class="bi bi-exclamation-diamond-fill"></i> Report</a></li><?php } ?>
                            </ul>
                        </div>
                    </div>
            </div>
        </div>
        <span style="display:block;margin-top: -35px;margin-left: 57px;font-size:small;font-weight:lighter" title="<?= $model->created_at ?>"><?= createAtPost($model->created_at) ?> . <i class='fas'>&#xf57d;</i></span>

        <?php $collections = $db->Where(['post_id' => $model->post_id], [Collection::TABLE]);
        if (count($collections) != 0) { ?>
            <div id="demo<?= $model->post_id ?>" class="carousel slide" style="padding-top:0.5rem!important;" data-bs-ride="carousel">
                <?= Theslideshow_carousel($collections, $model->user_id) ?>
                <?= Leftandrightcontrols_icons($collections, $model->post_id) ?>
            </div>
        <?php } ?>

        <h4 style="font-size: x-larger" class="p-2 border-bottom"><?= LikeStatus($user->id, $model->post_id) ?>&nbsp;&nbsp;<i class="bi bi-chat-left show-post-modal" data-bs-toggle="modal" data-bs-target="#postModal" data-post-id="<?= $model->post_id ?>"></i>
        </h4>
        <span class="p-1 mx-2 show-like-modal" style="font-weight:bold;" data-bs-toggle="modal" data-bs-target="#likeModal" data-post-id="<?= $model->post_id ?>"><span id="number-of-likes-<?= $model->post_id ?>"><?= numberOfLikes($model->post_id) ?></span> likes</span>
        <?php if ($model->post_text) { ?>
            <span class="p-1 mx-2"><span style="font-weight:bold"><?= $model->first_name . ' ' . $model->last_name ?></span> <?= $model->post_text ?></span>
        <?php } ?>

        <span class="p-1 mx-2 card-body show-post-modal" id="number-of-comments-<?= $model->post_id ?>" data-bs-toggle="modal" data-bs-target="#postModal" data-post-id="<?= $model->post_id ?>" style="font-weight:lighter;display:<?= numberOfComments($model->post_id) ? 'block' : 'none' ?>">Views all <?= numberOfComments($model->post_id) ?> comments</span>

        <?= ShowMostRecentComments($model->post_id) ?>
        <div id='show-upload-comment-<?= $model->post_id ?>' class="p-1 mx-2"></div>
        <div class="input-group p-2">
            <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="Say something.." aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-primary rounded-0 border-0" type="button" id="button-addon2" onclick="AddComment(event.currentTarget,'<?= $model->post_id ?>')">Post</button>
        </div>
    </div>
</div>
<?= showPage('footer') ?>
<script>
    const params = new URLSearchParams(window.location.search);
    const comment = params.get('comment_id')
    if(comment)
    {
        $('.show-post-modal').trigger('click');
        setTimeout(()=>{
            $('#comment_show_id_'+comment).css('background-color','beige');
        },100);
    }
   
</script>