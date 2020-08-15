<?php
    //Load Navigation With Logged in User Session
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
            $profilePic = "<img src='assets/img/boy.png' class='img-fluid' alt='Admin Dpic'>";
        }
        else
        {
            $profilePic = "<img src='assets/img/$admin->admin_profile_pic' class='img-fluid' alt='Admin Dpic'>";
        }
?>
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="dashboard.php">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="dashboard.php" class="nav-link">LMS</a>
                </li>
            </ul>

            <ul class="navbar-item flex-row ml-md-0 ml-auto">
                
            </ul>

            <ul class="navbar-item flex-row ml-md-auto">
                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?php echo $profilePic;?>
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a class="" href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> My Profile</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="change_password.php">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 9.9-1"></path></svg> 
                                    Change Password
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="lockscreen.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> Lock Screen</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Sign Out</a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </header>
    </div>
<?php }?>