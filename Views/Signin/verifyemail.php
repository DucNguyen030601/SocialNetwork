<?=showPage('header',['page_title'=>'Verify Email'])?>
<div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
                <div class="d-flex justify-content-center">
                </div>
                <h1 class="h5 mb-3 fw-normal">Verify Your Email Id (<?=$model->email?>)</h1>
                <form action="" method="POST">
                <p>Enter 6 Digit Code Sended to You</p>
                <div class="form-floating mt-1">
                    <input type="password" name="code" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">######</label>
                </div>
                <?=showValidateVerifyEmailForm()?>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <button class="btn btn-primary"  type="submit">Verify Email</button>
                    <a  id="resendcode" class="text-decoration-none">Resend Code</a>
                    <a id="timerresendcode" style="display:none" class="text-decoration-none"></a>
                </div>
            </form>
                <br>
                <a href="../signin" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i>
                    Logout</a>
        </div>
    </div>
    <?=showPage('footer')?>
    <!-- <script> -->
            $( "#resendcode" ).click(function() {
                
                $.ajax({
                    url: '/pictogram/system/library/send_code.php?resendcode',
                    method: 'post',
                    data: { email: 'tivinha0944256436@gmail.com' },
                    success: function (response) {
                        debugger
                        if(response)
                    {
                            $('#showresendcode').html('<p class="alert alert-success" role="alert">Verification code resended!</p>');
                    }
                    else
                    $('#showresendcode').html('<p class="alert alert-danger" role="alert">Verification code have not resended!</p>');
                    }
                });
                $(this).attr("style", "display:none");
                $('#timerresendcode').attr("style", "display:block");

                var sec=59;
                timer = setInterval(()=>{
                    $('#timerresendcode').text("00:"+sec +" - Resend code");
                    sec--;
                    if(sec==0)
                    {
                        stopTimer(timer);
                    }

                },1000);
            });
            function stopTimer(timer)
            {
                clearInterval(timer);
                $("#resendcode").attr("style", "display:block");
                $('#timerresendcode').attr("style", "display:none");
                $('#showresendcode').html('');
            }
            function checkCode()
            {
                val = $('#code').val();
                url = window.location;
             
                if(!val) {alert('Enter digit code please!'); return false;}
                      $.ajax({
                    url: '/pictogram/system/library/send_code.php?checkdigitcode',
                    method: 'post',
                    data: { code: val,url:window.location.pathname },
                    success: function (response) {
                        if(response==0)
                        {
                            alert('Digit code is incorrect!');
                            return false;
                        }
                        else if(response==2){
                            debugger
                           $('form').attr('action','/pictogram/test.php');
                           return true;
                        }
                        else
                        {
                            debugger
                            $('form').attr('action','/pictogram/test.php');
                           return true;
                        }
                    }
                    });
                    return false;
            
                }
            
               
            

    </script>