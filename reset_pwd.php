<?php
    session_start();
    include('config/config.php');
    require_once('config/code-generator.php');

    if(isset($_POST['reset_pwd']))
    {
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $err = 'Invalid Email';
        }
        $checkEmail = mysqli_query($mysqli, "SELECT `login_user_name` FROM `login` WHERE `login_user_name` = '".$_POST['email']."'") or exit(mysqli_error($mysqli));
        if( mysqli_num_rows($checkEmail) > 0 )  {
            //exit('This email is already being used');
            //Reset Password
            $reset_code = $_POST['reset_code'];
            $reset_token = sha1(md5($_POST['reset_token']));
            $reset_status = $_POST['reset_status'];
            $email = $_POST['email'];
            $query="INSERT INTO password_resets (email, reset_code, reset_token, reset_status) VALUES (?,?,?,?)";
            $reset = $mysqli->prepare($query);
            $rc=$reset->bind_param('ssss', $email, $reset_code, $reset_token, $reset_status);
            $reset->execute();
            if($reset)
            {
                $success = "Password Reset Instructions Sent To Your Email";
                // && header("refresh:1; url=index.php");
            }
            else
            {
                $err = "Please Try Again Or Try Later";
            }
             
        }
        else 
        {
            $err = "No account with that email";
        }
            
    }
 require_once('partials/_head.php');
?>
<body class="form no-image-content">
    

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Password Recovery</h1>
                        <p class="signup-link recovery">Enter your email and instructions will sent to you!</p>
                        <form  method = "post" class="text-left">
                            <div class="form">
                                <div id="email-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="email">Email</label>
                                        <a href="login.php" class="forgot-pass-link">Remembered Password?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input id="email" name="email" type="text" class="form-control" value="" placeholder="Email">
                                </div>
                                <div style="display:none">
                                    <input type="text" value="<?php echo $tk;?>" name="reset_token">
                                    <input type="text" value="<?php echo $rc;?>" name="reset_code">
                                    <input type="text" value="Pending" name="reset_status">
                                </div>
                                <div class="d-sm-flex justify-content-between">

                                    <div class="field-wrapper">
                                        <button type="submit" name="reset_pwd" class="btn btn-primary" value="">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <?php
        require_once('partials/_head.php');
    ?>
</body>

</html>
