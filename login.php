<?php
    session_start();
    include('config/config.php');
    //login 
    if(isset($_POST['login']))
    {
       $login_user_permission = $_POST['login_user_permission'];
       $login_user_name = $_POST['login_user_name'];
       $login_password = sha1(md5($_POST['login_password']));//double encrypt to increase security
       $stmt=$mysqli->prepare("SELECT login_user_permission, login_user_name, login_password, login_id  FROM login  WHERE (login_user_permission =? AND login_user_name =? AND login_password =?)");//sql to log in user
       $stmt->bind_param('iss',  $login_user_permission, $login_user_name, $login_password);//bind fetched parameters
       $stmt->execute();//execute bind 
       $stmt -> bind_result($login_user_permission, $login_user_name, $login_password, $login_id);//bind result
       $rs=$stmt->fetch();
       $_SESSION['login_id'] = $login_id;
       $_SESSION['login_user_name'] = $login_user_name;
       if($rs && $login_user_permission == '1')
       {
         //if its sucessfull
         header("location:dashboard.php");
       }
       else
       {
         $err = "Incorrect Authentication Credentials ";
       }
    }
    require_once('partials/_head.php');
?>
<body class="form">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Library Management System</h1>
                        <p class="">Administrator Login Panel</p>
                        
                        <form method="post" class="text-left">
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USERNAME | EMAIL</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="username" required name="login_user_name" type="text" class="form-control">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                        <a href="index.php" class="forgot-pass-link">Home</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" required name="login_password" type="password" class="form-control">
                                    <input id="text" name="login_user_permission" type="hidden" value="1"  class="form-control">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" name="login" class="btn btn-primary" value="">Log In</button>
                                    </div>
                                </div>
                                <!--
                                    <div class="division">
                                        <span>OR</span>
                                    </div>

                                    <div class="social">
                                        <a href="javascript:void(0);" class="btn social-fb">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg> 
                                            <span class="brand-name">Facebook</span>
                                        </a>
                                    <a href="javascript:void(0);" class="btn social-github">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                                            <span class="brand-name">Github</span>
                                        </a>
                                    </div>
                                -->
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once('partials/_scripts.php');
    ?>
</body>

</html>
