<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
    if(isset($_POST['changePassword']))
    {
        
       //Change Password
       $error = 0;
       if (isset($_POST['old_password']) && !empty($_POST['old_password'])) {
           $old_password=mysqli_real_escape_string($mysqli,trim(sha1(md5($_POST['old_password']))));
       }else{
           $error = 1;
           $err="Old Password Cannot Be Empty";
       }
       if (isset($_POST['new_password']) && !empty($_POST['new_password'])) {
           $new_password=mysqli_real_escape_string($mysqli,trim(sha1(md5($_POST['new_password']))));
       }else{
           $error = 1;
           $err="New Password Cannot Be Empty";
       }
       if (isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])) {
           $confirm_password=mysqli_real_escape_string($mysqli,trim(sha1(md5($_POST['confirm_password']))));
       }else{
           $error = 1;
           $err="Confirmation Password Cannot Be Empty";
       }

       if(!$error)
           {
               $login_user_name = $_SESSION['login_user_name'];
               $sql="SELECT * FROM  login  WHERE login_user_name = '$login_user_name'";
               $res=mysqli_query($mysqli,$sql);
               if (mysqli_num_rows($res) > 0) {
               $row = mysqli_fetch_assoc($res);
               if ($old_password != $row['login_password'])
               {
                   $err =  "Please Enter Correct Old Password";
               }
               elseif($new_password != $confirm_password)
               {
                   $err = "Confirmation Password Does Not Match";
               }
               else
               {
                       
                $login_user_name = $_SESSION['login_user_name'];
                $new_password  = sha1(md5($_POST['new_password']));
                //Insert Captured information to a database table
                $query="UPDATE login SET  login_password =? WHERE login_user_name =?";
                $stmt = $mysqli->prepare($query);
                //bind paramaters
                $rc=$stmt->bind_param('ss', $new_password, $login_user_name);
                $stmt->execute();

                //declare a varible which will be passed to alert function
                if($stmt)
                {
                    $success = "Password Changed" && header("refresh:1; url=profile.php");
                }
                else 
                {
                    $err = "Please Try Again Or Try Later";
                }
           }
        }
       
    }
}
    
    require_once('partials/_head.php');
?>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php require_once('partials/_navbar.php');?>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Profile</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Change Password</span></li>
                            </ol>
                        </nav>
                    </div>
                </li>
            </ul>

        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php require_once('partials/_sidebar.php');?>
        <!--  END SIDEBAR  -->
        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="container">
                <div class="container">
                    <br>
                    <div class="row">
                        <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>Fill All Fields</h4>
                                        </div>                                                                        
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Old Password</label>
                                                <input type="password" name="old_password" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">New Password</label>
                                                <input type="password" name="new_password" class="form-control">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="inputPassword4">Confirm New Password</label>
                                                <input type="password" name="confirm_password" " class="form-control">
                                            </div>
                                        </div>
                                      <button type="submit" name="changePassword" class="btn btn-primary mt-3">Change Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                require_once('partials/_footer.php');
            ?>
        </div>
        <!--  END CONTENT PART  -->
    </div>
    <?php require_once('partials/_scripts.php');?>   
</body>

</html>