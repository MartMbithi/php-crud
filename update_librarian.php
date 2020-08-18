<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
     if(isset($_POST['update_librarian']))
    {
            $error = 0;
            if (isset($_POST['librarian_name']) && !empty($_POST['librarian_name'])) {
                $librarian_name=mysqli_real_escape_string($mysqli,trim($_POST['librarian_name']));
            }else{
                $error = 1;
                $err="Name Cannot Be Empty";
            }
            if (isset($_POST['librarian_number']) && !empty($_POST['librarian_number'])) {
                $librarian_number=mysqli_real_escape_string($mysqli,trim($_POST['librarian_number']));
            }else{
                $error = 1;
                $err="Librarian Number Cannot Be empty";
            }
            if (isset($_POST['librarian_email']) && !empty($_POST['librarian_email'])) {
                $librarian_email =mysqli_real_escape_string($mysqli,trim($_POST['librarian_email']));
            }else{
                $error = 1;
                $err="Librarian Email Cannot Be Empty";
            }
            if (isset($_POST['librarian_phone_number']) && !empty($_POST['librarian_phone_number'])) {
                $librarian_phone_number=mysqli_real_escape_string($mysqli,trim($_POST['librarian_phone_number']));
            }else{
                $error = 1;
                $err="Phone Number Cannot Be Empty";
            }
            
                $librarian_name = $_POST['librarian_name'];
                $librarian_number = $_POST['librarian_number'];
                $librarian_email = $_POST['librarian_email'];
                $librarian_phone_number = $_POST['librarian_phone_number'];
                $librarian_address = $_POST['librarian_address'];
                $librarian_profile_picture = $_FILES["librarian_profile_picture"]["name"];
                move_uploaded_file($_FILES["librarian_profile_picture"]["tmp_name"],"assets/img/librarian/".$_FILES["librarian_profile_picture"]["name"]);
                //$librarian_account_status = $_POST['librarian_account_status'];
                $librarian_login_id = $_POST['librarian_login_id'];  
                $update = $_GET['update']; 
                $librarian_bio = $_POST['librarian_bio'];         

                //Insert Captured information to a database table
                $postQuery="UPDATE librarians SET librarian_bio=?, librarian_name =?, librarian_number =?, librarian_email =?, librarian_phone_number =?, librarian_address =?, librarian_profile_picture =?, librarian_login_id =? WHERE librarian_id =?";
                $postStmt = $mysqli->prepare($postQuery);
                //bind paramaters
                $rc=$postStmt->bind_param('ssssssssi', $librarian_bio, $librarian_name, $librarian_number, $librarian_email, $librarian_phone_number, $librarian_address, $librarian_profile_picture,  $librarian_login_id, $update);
                $postStmt->execute();
                //declare a varible which will be passed to alert function
                if($postStmt)
                {
                    $success = "Librarian Account Updated" && header("refresh:1; url=manage_librarians.php");
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
        $ret="SELECT * FROM  librarians WHERE librarian_id = '$update'"; 
        $stmt= $mysqli->prepare($ret) ;
        $stmt->execute();
        $res=$stmt->get_result();
        while($lib=$res->fetch_object())
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Librarians</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Manage Librarians</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Update Librarian</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span><?php echo $lib->librarian_name;?></span></li>
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
                                                <input type="text" value="<?php echo $lib->librarian_name;?>" name="librarian_name" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Librarian Number</label>
                                                <input type="text" name="librarian_number" value="<?php echo $lib->librarian_number;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress">Email Address</label>
                                                <input type="email" name="librarian_email" value="<?php echo $lib->librarian_email;?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputAddress2">Phone Number</label>
                                                <input type="text" name="librarian_phone_number" value="<?php echo $lib->librarian_phone_number;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputCity">Address</label>
                                                <input type="text" name="librarian_address" value="<?php echo $lib->librarian_address;?>" class="form-control" id="inputCity">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputState">Profile Picture</label>
                                                <input type="file" name="librarian_profile_picture" class="form-control btn btn-outline-success">                                                
                                            </div>
                                            <!--
                                            <div class="form-group col-md-2">
                                                <label for="inputZip">Account Status</label>
                                                <select name="librarian_account_status" class="form-control" >
                                                    <option><?php echo $lib->librarian_account_status;?></option>
                                                    <option>Can Login</option>
                                                    <option>Denied Login</option>
                                                </select>
                                            </div>
                                            -->
                                            <div class="form-group col-md-6" style="display:none">
                                                <label for="inputCity">Login Id</label>
                                                <input type="text" name="librarian_login_id" value="<?php echo $lib->librarian_login_id;?>" class="form-control">
                                            </div>                                            
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputAddress">Bio | About | Description</label>
                                                <textarea  name="librarian_bio" rows="5" class="form-control"><?php echo $lib->librarian_bio;?></textarea>
                                            </div>
                                        </div>
                                      <button type="submit" name="update_librarian" class="btn btn-primary mt-3">Update</button>
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