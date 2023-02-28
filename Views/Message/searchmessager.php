<?php if(count($model)==0){?>
<p class="text-center text-muted">no user found !</p>
<?php } else{
 foreach ($model as $key => $value) { 
    if((array)$value['message']) {?>
<div class="d-flex justify-content-between border-bottom ">
    <div class="d-flex align-items-center p-2" data-bs-toggle="modal" data-bs-target="#popupChat" onclick="popup_chat(<?=$value['user']->id?>)">
        <div><img src="/pictogram/upload/<?php echo 'user' . $value['user']->id . '/' . $value['user']->profile_pic ?>" alt="" height="40" width="40" style="object-fit:cover" class="rounded-circle border"></div>
        <div>&nbsp;&nbsp;</div>
        <div class="d-flex flex-column justify-content-center">
            <a class="text-decoration-none text-dark">
                <h6 style="margin: 0px;font-size: small;"><?= $value['user']->first_name . ' ' . $value['user']->last_name ?></h6>
            </a>
            <p style="margin:0px;font-size:small;<?= $value['unread'] ? 'font-weight:bold;color:blue' : '' ?>"><?= $value['message']->from_user_id ?>: <?= $value['message']->msg ?></p>
            <time style="font-size:small" class="timeago text-small text-muted" datetime="<?= createAtNotification($value['message']->created_at) ?>"><?= createAtNotification($value['message']->created_at) ?></time>
        </div>
    </div>
    <div class="d-flex align-items-center">
        <?php if ($value['unread']) { ?> <span class="badge bg-danger rounded-pill float-end"><?= $value['unread'] ?></span><?php } ?>
        <?php if ($value['blocked']) { ?> <span class="badge bg-danger">Blocked</span><?php } ?>
    </div>
</div>

<?php }else{?>

    <div class="d-flex justify-content-between border-bottom">
    <div class="d-flex align-items-center p-2" data-bs-toggle="modal" data-bs-target="#popupChat" onclick="popup_chat(<?=$value['user']->id?>)">
        <div><img src="/pictogram/upload/<?php echo 'user' . $value['user']->id . '/' . $value['user']->profile_pic ?>" alt="" height="40" width="40" style="object-fit:cover" class="rounded-circle border"></div>
        <div>&nbsp;&nbsp;</div>
        <div class="d-flex flex-column justify-content-center">
            <a class="text-decoration-none text-dark">
                <h6 style="margin: 0px;font-size: small;"><?= $value['user']->first_name . ' ' . $value['user']->last_name ?></h6>
            </a>
            <p style="margin:0px;font-size:small">@<?= $value['user']->username ?>: <b>NO MESSAGE</b></p>
        </div>
    </div>
</div>

   <?php }}}?>  