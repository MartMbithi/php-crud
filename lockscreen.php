<?php 
    session_start();
    require_once('config/config.php');
    //handle unlock
    if(isset($_POST['unlock']))
    {
        $login_user_name = $_POST['login_user_name'];
        $login_password = sha1(md5($_POST['login_password']));//double encrypt to increase security
        $stmt=$mysqli->prepare("SELECT login_user_name, login_password  FROM login  WHERE login_user_name =? AND login_password =?");//sql to log in user
        $stmt->bind_param('ss',  $login_user_name, $login_password);//bind fetched parameters
        $stmt->execute();//execute bind 
        $stmt -> bind_result($login_user_name, $login_password);//bind result
        $rs=$stmt->fetch();
        if($rs)
            {
                //if its sucessfull
                header("location:dashboard.php");
            }
        else
            {
                $err = "Incorrect Password";
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
                        <?php
                            $login_user_name = $_SESSION['login_user_name'];
                            //$login_id = $_SESSION['login_id'];
                            $ret = "SELECT * FROM  administrator  WHERE admin_email = '$login_user_name' || admin_username = '$login_user_name' "; 
                            $stmt = $mysqli->prepare($ret) ;
                            $stmt->execute() ;
                            $res = $stmt->get_result();
                            while($admin = $res->fetch_object())
                            {
                                //default profile pic if logged in user has no profile picture
                                if($admin->admin_profile_pic == '')
                                {
                                    $profilePic = "<img src='assets/img/boy.png' class='usr-profile' alt='Admin Dpic'>";
                                }
                                else
                                {
                                    $profilePic = "<img src='assets/img/$admin->admin_profile_pic' class='usr-profile' alt='Admin Dpic'>";
                                }
                            
                        ?>
                            <div class="d-flex user-meta">
                                <?php echo $profilePic;?>
                                <div class="">
                                    <p class=""><?php echo $admin->admin_username;?></p>
                                </div>
                            </div>
                            <form method="post" class="text-left">
                                <div class="form">
                                    <div id="password-field" class="field-wrapper input mb-2">
                                        <div class="d-flex justify-content-between">
                                            <label for="password">PASSWORD</label>
                                            <a href="logout.php" class="forgot-pass-link">Log Out?</a>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                        <input required id="password" name="login_password" type="password" class="form-control" placeholder="Password">
                                        <input id="email" style="display:none" name="login_user_name" value="<?php echo $admin->admin_email;?>" type="email" class="form-control">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </div>
                                    <div class="d-sm-flex justify-content-between">
                                        <div class="field-wrapper">
                                            <button type="submit" name="unlock" class="btn btn-primary" value="">Unlock</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        <?php }?>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <?php require_once('partials/_scripts.php');?>
    <script type = "text/javascript" >
        //Prevent use of back arrow after locking screen
        var path = 'lockscreen.php'; 
        history.pushState(null, null, path + window.location.search);
        window.addEventListener('popstate', function (event) {
            history.pushState(null, null, path + window.location.search);
        });
    </script>
</body>

</html>