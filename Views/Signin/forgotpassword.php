<?=showPage('header',['page_title'=>'Forgot Password'])?>
<div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form action="../signin/forgotpassword" method="POST">
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">Forgot Your Password?</h1>
                <div class="form-floating mt-1">

                <input type="text" name="email" class="form-control rounded-0" placeholder="username/email" value="<?=$model->email?>">
                    <label for="floatingInput">enter your email</label>
                </div>
                <?=showValidateForgotPasswordForm()?>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit">Send Verification Code</button>

                </div>
                <br>
                <a href="../signin" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i>
                    Go Back To Login</a>
            </form>
        </div>
    </div>
    <?=showPage('footer')?>