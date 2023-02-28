<?php
$user_id = $_SESSION[User::TABLE]['id'];
if (count($model) == 0) echo '<p class="p-2 mx-2 bg-white border rounded text-center">Be The First To Comment</p>';
else {
    foreach ($model as $key => $value) { ?>
        <div class="d-flex align-items-center p-2" style="position:relative">
            <div><img src="/pictogram/upload/user<?= $value->user_id . '/' . $value->profile_pic ?>" alt="" style="object-fit:cover" height="50" width="50" class="rounded-circle border"></div>
            <div>&nbsp;&nbsp;&nbsp;</div>
            <div class="d-flex flex-column justify-content-start align-items-start">
                <h6 style=" margin: 0px;"> <?= $value->first_name . ' ' . $value->last_name ?> <span style="font-size:x-small;font-weight:lighter" title="<?= $value->created_at ?>"><?= createAtComment($value->created_at) ?></span></h6>
                <div class="dropdown" style="position:absolute;right:0.5em">
                    <span type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php if ($value->user_id == $user_id || $value->post_user == $user_id) { ?>
                            <li onclick="DeleteComment('<?= $value->post_id ?>','<?= $value->comment_id ?>')"><a class="dropdown-item"><i class="bi bi-trash-fill"></i> Delete</a></li><?php } ?>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-exclamation-diamond-fill"></i> Report</a></li>
                    </ul>
                </div>
                <p style="margin:0px;" class="text-muted"><?= $value->comment ?></p>
            </div>
        </div>
<?php }
} ?>