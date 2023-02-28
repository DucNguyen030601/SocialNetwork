<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">
        <div class="modal-header">
            <h5 class="modal-title">Reporter</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php foreach ($model as $key => $value) { ?>
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center p-2">
                    <div><img src="/pictogram/upload/user<?= $value->id . '/' . $value->profile_pic ?>" alt=""
                            height="40" width="40" style="object-fit:cover" class="rounded-circle border">
                    </div>
                    <div>&nbsp;&nbsp;</div>
                    <div class="d-flex flex-column justify-content-center">
                        <a class="text-decoration-none text-dark">
                            <h6 style="margin: 0px;font-size: small;">
                                <?= $value->first_name . ' ' . $value->last_name ?>
                            </h6>
                        </a>
                        <p style="margin:0px;font-size:small" class="text-muted">@<?= $value->username ?>
                        </p>
                    </div>
                </div>
                <div class="d-flex align-items-center">

                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>