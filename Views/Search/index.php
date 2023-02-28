<?php if(count($model)==0){?>
<p class="text-center text-muted">no user found !</p>
<?php } else{
    $fbtn='';
    foreach ($model as $key => $value) {?>
<div class="d-flex justify-content-between">
    <div class="d-flex align-items-center p-2">
        <div><img src="upload/user<?= $value->id . '/' . $value->profile_pic ?>" alt="" height="40" width="40"
                style="object-fit:cover" class="rounded-circle border">
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
</div><?php }}?>