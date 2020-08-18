<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
     if(isset($_POST['givePermissions']))
    {
            
            
            $student_account_status = $_POST['student_account_status'];
            $user = $_GET['user']; 

            $login_id = $_POST['login_id'];
            $login_user_name =$_POST['login_user_name'];
            $login_password = sha1(md5($_POST['login_password']));

            //Insert Captured information to a database table
            $postQuery="UPDATE students SET student_account_status=? WHERE student_id =?";
            $loginQry = "INSERT INTO login (login_id, login_user_name, login_password) VALUES(?,?,?)";
            $postStmt = $mysqli->prepare($postQuery);
            $loginStmt = $mysqli->prepare($loginQry);
            //bind paramaters
            $rc=$postStmt->bind_param('si', $student_account_status, $user);
            $rc=$loginStmt->bind_param('sss', $login_id, $login_user_name, $login_password);
            $postStmt->execute();
            $loginStmt->execute();
            //declare a varible which will be passed to alert function
            if($postStmt && $loginStmt)
            {
                $success = "Login Permissions Granted" && header("refresh:1; url=manage_students.php");
            }
            else 
            {
                $err = "Please Try Again Or Try Later";
            } 
        }
    require_once('partials/_head.php');
    require_once('config/code-generator.php');
?>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php
        require_once('partials/_navbar.php');
        $user = $_GET['user'];
        $ret="SELECT * FROM  students WHERE student_id = '$user'"; 
        $stmt= $mysqli->prepare($ret) ;
        $stmt->execute();
        $res=$stmt->get_result();
        while($std=$res->fetch_object())
        {
    ?>
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Students</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Manage Students</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Login Permissions</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span><?php echo $std->student_name;?></span></li>
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
                                                <label for="inputEmail4">Full Name</label>
                                                <input type="text" readonly value="<?php echo $std->student_name;?>" name="student_name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Student Reg Number</label>
                                                <input type="text" readonly name="student_reg_number" value="<?php echo $std->student_reg_number;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress">Login ID </label>
                                                <input type="text" readonly name="login_id" value="<?php echo $std->student_login_id;?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6" style="display:none">
                                                <label for="inputAddress">Account Status </label>
                                                <input type="text" name="student_account_status" value="Can Login" class="form-control">
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress2">Login Email</label>
                                                <input type="text" name="login_user_name" value="<?php echo $std->student_email;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputCity">Login Password</label>
                                                <input type="text" name="login_password" class="form-control" id="inputCity">
                                            </div>
                                        </div>
                                      <button type="submit" name="givePermissions" class="btn btn-primary mt-3">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                require_once('partials/_footer.php');
                }
            ?>
        </div>
        <!--  END CONTENT PART  -->
    </div>
    <?php require_once('partials/_scripts.php');?>   
</body>

</html>