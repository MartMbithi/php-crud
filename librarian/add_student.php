<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
     if(isset($_POST['add_student']))
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
            if(!$error)
            {
                //Check if student number / email  already exists
                $sql="SELECT * FROM  students WHERE  student_reg_number='$student_reg_number' || student_email='$student_email' ";
                $res=mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                if ($student_reg_number == $row['student_reg_number'])
                {
                    $err =  "Student With That Registration Number Exists";
                }
                else
                {
                    $err =  "Email Address Already Taken";
                }
            }
            else
            {
                $student_name = $_POST['student_name'];
                $student_reg_number = $_POST['student_reg_number'];
                $student_email = $_POST['student_email'];
                $student_gender = $_POST['student_gender'];
                $student_phone_number = $_POST['student_phone_number'];
                $student_address = $_POST['student_address'];
                $student_profile_picture = $_FILES['student_profile_picture']['name'];
                move_uploaded_file($_FILES["student_profile_picture"]["tmp_name"],"assets/img/std/".$_FILES["student_profile_picture"]["name"]);
                $student_account_status = $_POST['student_account_status'];
                $student_login_id = $_POST['student_login_id'];     
                $student_bio = $_POST['student_bio'];          

                //Insert Captured information to a database table
                $postQuery="INSERT INTO students (student_bio, student_name, student_reg_number, student_email, student_gender, student_phone_number, student_address, student_profile_picture, student_account_status, student_login_id) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $postStmt = $mysqli->prepare($postQuery);
                //bind paramaters
                $rc=$postStmt->bind_param('ssssssssss', $student_bio, $student_name, $student_reg_number, $student_email, $student_gender, $student_phone_number, $student_address, $student_profile_picture, $student_account_status, $student_login_id);
                $postStmt->execute();
                //declare a varible which will be passed to alert function
                if($postStmt)
                {
                    $success = "Student Added" && header("refresh:1; url=add_student.php");
                }
                else 
                {
                    $err = "Please Try Again Or Try Later";
                } 
            }
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Students</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Add Student</span></li>
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
                                                <input type="text" name="student_name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Student Registration Number</label>
                                                <input type="text" name="student_reg_number" value="LMS-<?php echo $alpha;?>-<?php echo $beta;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress">Email Address</label>
                                                <input type="email" name="student_email"  class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress2">Phone Number</label>
                                                <input type="text" name="student_phone_number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-4">
                                                <label for="inputCity">Address</label>
                                                <input type="text" name="student_address" class="form-control" id="inputCity">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputState">Profile Picture</label>
                                                <input type="file" name="student_profile_picture" class="form-control btn btn-outline-success">                                                
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputZip">Gender</label>
                                                <select name="student_gender" class="form-control" >
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                            <div style="display: none;" class="form-group col-md-6">
                                                <label for="inputZip">Account Status</label>
                                                <select name="student_account_status" class="form-control" >
                                                    <option>Can Login</option>
                                                    <option selected>Denied Login</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6" style="display:none">
                                                <label for="inputCity">Login Id</label>
                                                <input type="text" name="student_login_id" class="form-control" value="<?php echo sha1(md5($beta));?>">
                                            </div>                                            
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputAddress">Bio | About | Description</label>
                                                <textarea  name="student_bio" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                      <button type="submit" name="add_student" class="btn btn-primary mt-3">Add Student</button>
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