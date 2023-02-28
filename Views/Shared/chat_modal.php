<?php
global $db;
$from_user = $models[0];
$to_user = $models[1];
$model = $models[2]; 
$request = $models[3];
$current_date = createAtChat_title(date('F j, Y'));
$title_date = '';
?>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center p-3 " style="border-top: 4px solid #0d6ffd;">
    <h5 class="mb-0"><img src="upload/user<?= $from_user->id . '/' . $from_user->profile_pic ?>" alt="" id="chatter_pic" height="45" width="45" style="object-fit:cover" class="rounded-circle border"> <?=$from_user->first_name.' '.$from_user->last_name?></h5>
    <div class="d-flex flex-row align-items-center">
      <span class="badge bg-primary me-3" id="numberOfMessages"><?=count($model)?></span>
      <!-- <i class="fas fa-minus me-3 text-muted fa-xs"></i>
              <i class="fas fa-comments me-3 text-muted fa-xs"></i> -->
      <i class="fas fa-times text-muted fa-xs" data-bs-dismiss="modal" aria-label="Close" onclick="StopChat()"></i>
    </div>
  </div>
  <div class="card-body" id="body_chat" style="position: relative; height: 400px;overflow:auto">
  <?php if (!count($model)) { ?>
  <div class="divider d-flex align-items-center mb-1">
    <p class="text-center mx-3 mb-0" style="color: #a2aab7;">
      NO MESSAGE
    </p>
  </div>
<?php
} ?>
    <?php
    for ($key = 0; $key < count($model); $key++) {
        $date = createAtChat_title($model[$key]->created_at);
      ?>
      <?php if($date!=$title_date){ 
         $title_date=$date;
         ?>
        <div class="divider d-flex align-items-center mb-1">
          <p class="text-center mx-3 mb-0" style="color: #a2aab7;"><?=$date==$current_date?'Today':$date?></p>
        </div>
     <?php }?>
      <?php if ($model[$key]->from_user_id != $to_user->id) { ?>
        <div class="d-flex flex-row justify-content-start mb-1 pt-2">
          <img src="upload/user<?= $from_user->id . '/' . $from_user->profile_pic ?>" alt="<?= $from_user->username ?>" style="object-fit:cover" height="45" width="45" class="rounded-circle border">
          <div>
            <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;"><?= $model[$key]->msg ?></p>
            <!-- <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">How are you ...???</p>
                <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">What are you doing tomorrow? Can we come up a bar?</p> -->
            <?php
            a:
            if (isset($model[$key + 1])) {
              if ($model[$key + 1]->from_user_id == $model[$key]->from_user_id) {
                $query = "SELECT * FROM messages WHERE id = {$model[$key + 1]->id}";
                $message = $db->getRow($query);
                $date1 = date_create($model[$key]->created_at);
                $date2 = date_create($message['created_at']);
                $diff = date_diff($date2, $date1);
                if ($diff->i < 5) {
                  echo '<p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">' . $message['msg'] . '</p>';
                  $key++;
                  goto a;
                }
              }
            }
            ?>
            <p class="small ms-3 mb-3 rounded-3 text-muted"><?=createAtChat($model[$key]->created_at)?></p>
          </div>
        </div>
      <?php } else { ?>
        <div class="d-flex flex-row justify-content-end mb-1 pt-2">
          <div>
            <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary"><?= $model[$key]->msg ?></p>
            <?php
            b:
            if (isset($model[$key + 1])) {
              if ($model[$key + 1]->to_user_id == $model[$key]->to_user_id) {
                $query = "SELECT * FROM messages WHERE id = {$model[$key + 1]->id}";
                $message = $db->getRow($query);
                $date1 = date_create($model[$key]->created_at);
                $date2 = date_create($message['created_at']);
                $diff = date_diff($date2, $date1);
                if ($diff->i < 5) {
                  echo '<p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">' . $message['msg'] . '</p>';
                  $key++;
                  goto b;
                }
              }
            }
            ?>
            <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end"><?=createAtChat($model[$key]->created_at)?></p>
          </div>
          <img src="upload/user<?= $to_user->id . '/' . $to_user->profile_pic ?>" alt="<?= $to_user->username ?>" style="object-fit:cover" height="45" width="45" class="rounded-circle border">
        </div>
    <?php }
    }
    ?>

<?php if ($request) { ?>
  <div class="divider d-flex align-items-center mb-1">
    <p class="text-center mx-3 mb-0" style="color: #a2aab7;">
    If you reply then you can message each other without opening the request.
    </p>
  </div>
<?php
} ?>
  </div>
  <div id="blerror" style="display:<?=checkBlockStatusByUserAndUserFound($to_user->id,$from_user->id)?'block':'none'?>">
  <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3" >
      <p class="p-2 text-danger mx-auto" > 
      <i class="bi bi-x-octagon-fill"></i> you are not allowed to send msg to this user anymore</p>
  </div>
  </div>

  <div id="msgsender" style="display:<?=checkBlockStatusByUserAndUserFound($to_user->id,$from_user->id)?'none':'block'?>">
  <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3" >
   <img src="upload/user<?= $to_user->id . '/' . $to_user->profile_pic ?>" alt="avatar 3" height="45" width="45" style="object-fit:cover" class="me-1 rounded-circle border">
    <textarea class="form-control message-input" rows="2" style="width: 80%;" ></textarea>
    <!-- <a class="ms-3 text-muted" href="#!"><i class="fas fa-smile"></i></a> -->
    <a class="ms-3" onclick="AddMessage(event.currentTarget,'<?= $from_user->id ?>')"><i class="fas fa-paper-plane"></i></a>
  </div>
</div>