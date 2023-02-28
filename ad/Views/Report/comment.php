<?= showPage('header', ['page_title' => 'Report - ADMIN']) ?>
<?= showPage('nav') ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Report</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Post</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Users Lists
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>#No</th>
                                <th>User</th>
                                <th>Comment</th>
                                <th>Created</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#No</th>
                                <th>User</th>
                                <th>Comment</th>
                                <th>Created</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($model as $key => $value) { ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <img src="/pictogram/upload/user<?= $value->id . '/' . $value->profile_pic ?>" alt="" style="object-fit:cover" height="50" width="50" class="rounded-circle border">
                                        <?= $value->first_name . ' ' . $value->last_name ?> - <span class="text-muted">@<?= $value->username ?></span><br>
                                        <span class="text-muted"><?= $value->email ?></span>
                                    </td>
                                    <td class="show-post-modal" data-bs-toggle="modal" data-bs-target="#postModal" data-post-id="<?= $value->post_id ?>" data-comment-id="<?=$value->type_id?>"> <?=substr($value->comment, 0, 20)?>...</td>
                                    <td><?= $value->created_at ?></td>
                                    <td class="show-reporter-modal" data-bs-toggle="modal" data-bs-target="#reporterModal" data-type-id="<?= $value->type_id ?>" data-type="<?=$value->type?>"><?= $value->count ?></td>
                                    <td><button class="btn btn-danger" onclick="DeleteComment(<?=$value->type_id?>)">Delete</button></td>
                                </tr>
                            <?php } ?>
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
<?php require('ad/Views/Shared/footer.php') ?>