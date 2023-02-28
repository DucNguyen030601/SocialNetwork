<?=showPage('header',['page_title'=>'Reset Password'])?>
<div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form action="" method="POST">
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">Forgot Your Password ?</h1>
                <p>Enter your new password - (<?=$model->email?>)</p>

                <div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">new password</label>
                </div>
                <?=showValidateResetPasswordForm()?>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit">Change Password</button>
                </div>
                <br>
                <a href="?login" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i> Go Back
                    To
                    Login</a>
            </form>
        </div>
    </div>
    <?=showPage('footer')?>