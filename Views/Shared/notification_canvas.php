<?php global $db;
foreach ($model as $key => $value) { 
    if($value->from_user_id>0){
        $from_user = $db->SingleOrDefault(['id'=>$value->from_user_id],User::TABLE,['id','first_name','last_name','username','profile_pic']);
    ?>
    <div class="d-flex justify-content-between border-bottom dropdown-hover" >
            <div class="dropdown show-dropdown" style="position:absolute;right:1em;display:none">
                <span type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li onclick="DeleteNotification(<?= $value->id?>)"><a class="dropdown-item"><i class="bi bi-trash-fill"></i> Delete</a></li>
                </ul>
            </div>
   
        <div class="d-flex align-items-center p-2" onclick="ReadNotification('<?= $value->id ?>')">
            <div><img src="/pictogram/upload/<?php echo "user$from_user->id/" . $from_user->profile_pic ?>" alt="" height="40" width="40" style="object-fit:cover" class="rounded-circle border"></div>
            <div>&nbsp;&nbsp;</div>
            <div class="d-flex flex-column justify-content-center" >
                <a class="text-decoration-none text-dark">
                    <h6 style="margin: 0px;font-size: small;"><?= $from_user->first_name . ' ' . $from_user->last_name ?></h6>
                </a>
                <p style="margin:0px;font-size:small" class="text-muted">@<?= $from_user->username ?> <?= $value->message ?></p>
                <time style="font-size:small" class="timeago text-muted text-small" datetime="<?= createAtNotification($value->created_at) ?>"><?= createAtNotification($value->created_at) ?></time>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <?php if (!$value->read_status) { ?> <div class="p-1 bg-primary rounded-circle"></div><?php } ?>
        </div>
    </div>
    <?php }else{?>
        <div class="d-flex justify-content-between border-bottom dropdown-hover" >
            <div class="dropdown show-dropdown" style="position:absolute;right:1em;display:none">
                <span type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li onclick="DeleteNotification(<?= $value->id?>)"><a class="dropdown-item"><i class="bi bi-trash-fill"></i> Delete</a></li>
                </ul>
            </div>
   
        <div class="d-flex align-items-center p-2" onclick="ReadNotification('<?= $value->id ?>')">
            <div><img src="/pictogram/public/images/pictogram.png" alt="" height="40" width="40" style="object-fit:cover" class="rounded-circle border"></div>
            <div>&nbsp;&nbsp;</div>
            <div class="d-flex flex-column justify-content-center" >
                <a class="text-decoration-none text-dark">
                    <h6 style="margin: 0px;font-size: small;color:red">ADMIN</h6>
                </a>
                <p style="margin:0px;font-size:small"><?= $value->message ?></p>
                <time style="font-size:small" class="timeago text-muted text-small" datetime="<?= createAtNotification($value->created_at) ?>"><?= createAtNotification($value->created_at) ?></time>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <span class="badge bg-danger">Report</span> &nbsp;&nbsp;<?php if (!$value->read_status) { ?> <div class="p-1 bg-primary rounded-circle"></div><?php } ?>
            
        </div>
        </div>

    <?php }} ?>
    <script>

        //for show hover messages,notifications
$(".dropdown-hover").hover(function(){
  $(this).find('.show-dropdown').css("display", "block");
  }, function(){
    $(this).find('.show-dropdown').css("display", "none");
});
    </script>