<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
    require_once('partials/_head.php');
?>
<body>
    
    <!--  BEGIN NAVBAR  -->
    <?php 
        require_once('partials/_navbar.php');
        //Get Logged In User Session
        $login_user_name = $_SESSION['login_user_name'];
        $ret = "SELECT * FROM  administrator  WHERE admin_email = '$login_user_name' || admin_username = '$login_user_name' "; 
        $stmt = $mysqli->prepare($ret) ;
        $stmt->execute() ;
        $res = $stmt->get_result();
        while($admin = $res->fetch_object())
        {
            //if admin has a profile pic
            if($admin->admin_profile_pic != '')
            {
                $default_img = "assets/img/$admin->admin_profile_pic'>";
            }
            else
            {
                $default_img = "assets/img/boy.png";
            }
    ?>
        <div class="sub-header-container">
            <header class="header navbar navbar-expand-sm">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
                <ul class="navbar-nav flex-row">
                    <li>
                        <div class="page-header">
                            <nav class="breadcrumb-one" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><span><?php echo $admin->admin_username;?></span></li>
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
        <?php 
            require_once('partials/_sidebar.php');
        ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">                
                    
                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="general-info" class="section general-info">
                                        <div class="info">
                                            <h6 class="">Update Profile</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                                            <div class="upload mt-4 pr-md-4">
                                                                <input type="file" name="admin_profile_pic" id="input-file-max-fs" class="dropify" data-default-file="<?php echo $default_img;?>" data-max-file-size="2M" />
                                                                <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Full Name</label>
                                                                            <input type="text" class="form-control mb-4" value="<?php echo $admin->admin_username;?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="fullName">Admin Number</label>
                                                                            <input type="text" class="form-control mb-4" value="<?php echo $admin->admin_number;?>">
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="profession">Admin Phone Number</label>
                                                                    <input type="text" class="form-control mb-4"  value="<?php echo $admin->admin_phone_number;?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-11 mx-auto">
                                                            <div class="form-group">
                                                                <label for="aboutBio">Bio</label>
                                                                <textarea class="form-control" name="admin_bio" placeholder="Tell something interesting about yourself" rows="5">
                                                                    <?php echo $admin->admin_bio;?>
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-11 mx-auto">
                                                            <div class="form-group">
                                                                <input type="submit" class="btn btn-outline-primary" name="updateProfile" value="Update Profile">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <?php
        require_once('partials/_scripts.php'); 
        }
    ?>
</body>

</html>