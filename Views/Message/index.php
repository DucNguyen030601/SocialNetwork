<?php
global $db;
$from_user = $models[0];
$to_user = $models[1];
$model = $models[2];
$request = $models[3];
$current_date = createAtChat_title(date('F j, Y'));
$title_date = '';
?>

<?php
for ($key = 0; $key < count($model); $key++) {
  $date = createAtChat_title($model[$key]->created_at);
?>
  <?php if ($date != $title_date) {
    $title_date = $date;
  ?>
    <div class="divider d-flex align-items-center mb-1">
      <p class="text-center mx-3 mb-0" style="color: #a2aab7;">
        <?= $date == $current_date ? 'Today' : $date ?>
      </p>
    </div>
  <?php
  } ?>
  <?php if ($model[$key]->from_user_id != $to_user->id) { ?>
    <div class="d-flex flex-row justify-content-start mb-1 pt-2">
      <img src="upload/user<?= $from_user->id . '/' . $from_user->profile_pic ?>" alt="<?= $from_user->username ?>" style="object-fit:cover" height="45" width="45" class="rounded-circle border">
      <div>
        <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">
          <?= $model[$key]->msg ?>
        </p>
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
        <p class="small ms-3 mb-3 rounded-3 text-muted">
          <?= createAtChat($model[$key]->created_at) ?>
        </p>
      </div>
    </div>
  <?php
  } else { ?>
    <div class="d-flex flex-row justify-content-end mb-1 pt-2">
      <div>
        <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
          <?= $model[$key]->msg ?>
        </p>
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
        <p class="small me-3 mb-3 rounded-3 text-muted d-flex justify-content-end">
          <?= createAtChat($model[$key]->created_at) ?>
        </p>
      </div>
      <img src="upload/user<?= $to_user->id . '/' . $to_user->profile_pic ?>" alt="<?= $to_user->username ?>" style="object-fit:cover" height="45" width="45" class="rounded-circle border">
    </div>
<?php
  }
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