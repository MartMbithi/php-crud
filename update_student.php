<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
     if(isset($_POST['update_student']))
    {
            $error = 0;
            if (isset($_POST['student_name']) && !empty($_POST['student_name'])) {
                $student_name=mysqli_real_escape_string($mysqli,trim($_POST['student_name']));
            }else{
                $error = 1;
                $err="Name Cannot Be Empty";
            }
            if (isset($_POST['student_reg_number']) && !empty($_POST['student_reg_number'])) {
                $student_reg_number=mysqli_real_escape_string($mysqli,trim($_POST['student_reg_number']));
            }else{
                $error = 1;
                $err="Admission Number Cannot Be empty";
            }
            if (isset($_POST['student_email']) && !empty($_POST['student_email'])) {
                $student_email =mysqli_real_escape_string($mysqli,trim($_POST['student_email']));
            }else{
                $error = 1;
                $err="Email Cannot Be Empty";
            }
            if (isset($_POST['student_phone_number']) && !empty($_POST['student_phone_number'])) {
                $student_phone_number=mysqli_real_escape_string($mysqli,trim($_POST['student_phone_number']));
            }else{
                $error = 1;
                $err="Phone Number Cannot Be Empty";
            }

            if (isset($_POST['student_address']) && !empty($_POST['student_address'])) {
                $student_address=mysqli_real_escape_string($mysqli,trim($_POST['student_address']));
            }else{
                $error = 1;
                $err="Address Cannot Be Empty";
            }                        
            
                $student_name = $_POST['student_name'];
                $student_reg_number = $_POST['student_reg_number'];
                $student_email = $_POST['student_email'];
                $student_gender = $_POST['student_gender'];
                $student_phone_number = $_POST['student_phone_number'];
                $student_address = $_POST['student_address'];
                $student_profile_picture = $_FILES['student_profile_picture']['name'];
                move_uploaded_file($_FILES["student_profile_picture"]["tmp_name"],"assets/img/std/".$_FILES["student_profile_picture"]["name"]);
                $student_account_status = $_POST['student_account_status'];
                $student_bio = $_POST['student_bio'];  
                $update = $_GET['update'];        

                //Insert Captured information to a database table
                $postQuery="UPDATE students SET student_bio =?, student_name =?, student_reg_number =?, student_email =?, student_gender =?, student_phone_number =?, student_address =?, student_profile_picture =?, student_account_status =? WHERE student_id =?";
                $postStmt = $mysqli->prepare($postQuery);
                //bind paramaters
                $rc=$postStmt->bind_param('sssssssssi', $student_bio, $student_name, $student_reg_number, $student_email, $student_gender, $student_phone_number, $student_address, $student_profile_picture, $student_account_status, $update);
                $postStmt->execute();
                //declare a varible which will be passed to alert function
                if($postStmt)
                {
                    $success = "Student Updated" && header("refresh:1; url=manage_students.php");
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
        $update = $_GET['update'];
        $ret="SELECT * FROM  students WHERE student_id = '$update' "; 
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Update Student</a></li>
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
                                                <input type="text" name="student_name" value="<?php echo $std->student_name;?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Student Registration Number</label>
                                                <input type="text" name="student_reg_number" value="<?php echo $std->student_reg_number;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress">Email Address</label>
                                                <input type="email" name="student_email" value="<?php echo $std->student_email;?>"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress2">Phone Number</label>
                                                <input type="text" name="student_phone_number" value="<?php echo $std->student_phone_number;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-4">
                                                <label for="inputCity">Address</label>
                                                <input type="text" name="student_address" value="<?php echo $std->student_address;?>" class="form-control" id="inputCity">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputState">Profile Picture</label>
                                                <input type="file" name="student_profile_picture" class="form-control btn btn-outline-success">                                                
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputZip">Gender</label>
                                                <select name="student_gender" class="form-control" >
                                                    <option><?php echo $std->student_gender;?></option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                            <div style="display:none" class="form-group col-md-6">
                                                <label for="inputZip">Account Status</label>
                                                <select name="student_account_status" class="form-control" >
                                                    <option selected><?php echo $std->student_account_status;?></option>
                                                    <option>Can Login</option>
                                                    <option>Denied Login</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputAddress">Bio | About | Description</label>
                                                <textarea  name="student_bio" rows="5" class="form-control"><?php echo $std->student_bio;?></textarea>
                                            </div>
                                        </div>
                                      <button type="submit" name="update_student" class="btn btn-primary mt-3">Update Student</button>
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
    <?php require_once('partials/_scripts.php'); }?>   
</body>

</html>