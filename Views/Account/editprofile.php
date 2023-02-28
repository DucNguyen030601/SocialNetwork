
<?=showPage('header',['page_title'=>'Edit Profile'])?>
<?=showPage('nav',$model)?>
    <div class="container col-9 rounded-0 d-flex justify-content-between">
        <div class="col-12 bg-white border rounded p-4 mt-4 shadow-sm">
            <form action="editprofile" method="POST" enctype="multipart/form-data">
           <input type="hidden" name="size" value="1000000">
                <div class="d-flex justify-content-center">
                </div>
                <h1 class="h5 mb-3 fw-normal">Edit Profile </h1><span style="text-decoration:underline;color:blue"> Last edited: <?=$model->updated_at?></span>
                <div class="form-floating mt-1 col-6">
                    <img src="/pictogram/upload/<?php echo "user$model->id/".$model->profile_pic?>" class="img-thumbnail my-3" style="height:150px;" alt="<?php echo "user$model->id/".$model->profile_pic?>" id="preview_update">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Change Profile Picture</label>
                        <input class="form-control" type="file" name="profile_pic"  accept="image/*" id="upload_file_update">
                    </div>
                </div>
                <?=showValidateUpdateForm((array)$model)?>
                <div class="d-flex">
                    <div class="form-floating mt-1 col-6 ">
                        <input type="text" name="first_name" class="form-control rounded-0" placeholder="firstname" value="<?=$model->first_name?>">
                        <label for="floatingInput">first name</label>
                    </div>
                    <div class="form-floating mt-1 col-6">
                        <input type="text" name="last_name" class="form-control rounded-0" placeholder="lastname" value="<?=$model->last_name?>">
                        <label for="floatingInput">last name</label>
                    </div>
                </div>
                <div class="d-flex gap-3 my-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios1"
                            value="1" <?=$model->gender==1?'checked':''?> disabled>
                        <label class="form-check-label" for="exampleRadios1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios3"
                            value="2" <?=$model->gender==2?'checked':''?> disabled>
                        <label class="form-check-label" for="exampleRadios3">
                            Female
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="exampleRadios2"
                            value="0"<?=$model->gender==0?'checked':''?> disabled>
                        <label class="form-check-label" for="exampleRadios2">
                            Other
                        </label>
                    </div>
                </div>
                <div class="form-floating mt-1">
                    <input type="email" name="email" class="form-control rounded-0" placeholder="username/email" value="<?=$model->email?>" disabled>
                    <label for="floatingInput">email</label>
                </div>
     
                <div class="form-floating mt-1">
                    <input type="text" name="username" class="form-control rounded-0" placeholder="username/email" value="<?=$model->username?>">
                    <label for="floatingInput">username</label>
                </div>

                <div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">new password</label>  
                    
                </div>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary" type="submit">Update Profile</button>



                </div>

            </form>
        </div>

    </div>
    <?=showPage('footer')?>