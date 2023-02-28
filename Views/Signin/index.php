

<?=showPage('header',['page_title'=>'Sign In'])?>
<div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form action="/pictogram/signin" method="POST">
                <div class="d-flex justify-content-center">
                    <img class="mb-4" src="/pictogram/public/images/pictogram.png" alt="" height="45">
                </div>
                <h1 class="h5 mb-3 fw-normal">Please sign in</h1>
                <?=showValidateSigninForm()?>
                <div class="form-floating">
                    <input type="text" name="username" class="form-control rounded-0" placeholder="username" value="<?=$model->username?>">
                    <label for="floatingInput">username/email</label>
                </div>

                <div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">password</label>
                </div>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit">Sign in</button>
                    <a href="signup" class="text-decoration-none">Create New Account</a>
                </div>

                <a href="signin/forgotpassword" class="text-decoration-none">Forgot password ?</a>
            </form>
        </div>
    </div>
    <?=showPage('footer')?>