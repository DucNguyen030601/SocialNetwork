
<?php
$totalUsers = $models[0];
$totalPosts = $models[1];
$totalComments = $models[2];
$totalLikes = $models[3];
$model = $models[4];
?>
<?= showPage('header', ['page_title' => 'Dashboard - ADMIN']) ?>
<?= showPage('nav') ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Home</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total Users</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <h1><?=$totalUsers?></h1>
                                        <i class='fas fa-user-friends' style = 'font-size:40px'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Total Posts</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <h1><?=$totalPosts?></h1>
                                        <i class='far fa-address-card' style = 'font-size:40px'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Comments</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <h1><?=$totalComments?></h1>
                                        <i class='far fa-comment-alt' style = 'font-size:40px'></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Total Likes</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <h1><?=$totalLikes?></h1>
                                        <i class='far fa-heart' style = 'font-size:40px'></i>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Users Lists
                            </div>
                            <div class="card-body" >
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#No</th>
                                            <th>User</th>
                                            <th>Created</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Login</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#No</th>
                                            <th>User</th>
                                            <th>Created</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th>Login</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($model as $key => $value) {?>
                                        <tr>
                                            <td><?=$key+1?></td>
                                            <td>
                                                <img src="/pictogram/upload/user<?= $value->id . '/' . $value->profile_pic ?>" alt="" style="object-fit:cover" height="50" width="50" class="rounded-circle border">
                                                <?=$value->first_name.' '.$value->last_name?> - <span class="text-muted">@<?=$value->username?></span><br>
                                                <span class="text-muted"><?=$value->email?></span>
                                            </td> 
                                            <td><?=$value->created_at?></td> 
                                            <td><?=StatusUser($value->ac_status)?></td>
                                            <td>
                                                <?=ActionUser($value->ac_status,$value->id)?>
                                            </td>
                                            <td> <button onclick="LoginUser(<?=$value->id?>)" class = "btn btn-success" ><i class="fas fa-sign-in-alt"></i></button></td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
<?php require('ad/Views/Shared/footer.php')?>