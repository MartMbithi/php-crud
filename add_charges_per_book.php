<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
    
        if(isset($_POST['charges']))
        {
            //Prevent Posting Blank Values
            if ( empty($_POST["charge_name"]) || empty($_POST["charge_desc"]) || empty($_POST['charge_amount']) ) 
            {
                $err="Blank Values Not Accepted";
            }
            else
            {  
                $charge_name = $_POST['charge_name'];
                $charge_desc = $_POST['charge_desc'];
                $charge_amount = $_POST['charge_amount'];
                $charge_id = $_POST['charge_id'];

                //Mantain Foreign Keys
                $id  = $_GET['id'];
                    
                //Insert Captured information to a database table
                $postQuery="INSERT INTO charges (charge_id, charge_name, charge_desc, charge_amount) VALUES(?,?,?,?)";
                $frQry = "INSERT INTO operation_charges (operation_charge_charge_id, operation_charge_student_operation_id) VALUES(?,?)";
                //$upQr="UPDATE library_operations SET operation_charge =? WHERE operation_id =?";
                $postStmt = $mysqli->prepare($postQuery);
                $frStmt = $mysqli->prepare($frQry);
                //$upStmt = $mysqli->prepare(($upQr));
                //bind paramaters
                $rc=$postStmt->bind_param('ssss', $charge_id, $charge_name, $charge_desc, $charge_amount);
                $rc=$frStmt->bind_param('ss', $charge_id, $id);
                //$rc=$upStmt->bind_param('ss', $operation_charge, $id);
                $postStmt->execute();
                $frStmt->execute();
                //$upStmt->execute();

                //declare a varible which will be passed to alert function
                if($postStmt && $frStmt )
                {
                    $success = "Charge Added" && header("refresh:1; url=manage_charges.php");
                }
                else 
                {
                    $err = "Please Try Again Or Try Later";
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
    <?php 
        require_once('partials/_navbar.php');
        $id = $_GET['id'];
        $ret="SELECT * FROM library_operations WHERE operation_id = '$id'"; 
        $stmt= $mysqli->prepare($ret) ;
        $stmt->execute();
        $res=$stmt->get_result();
        while($book=$res->fetch_object())
        {
    ?>
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Charges</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Add <?php echo $book->operation_type;?> Book Charges</span></li>
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
                                                <label for="inputEmail4">Charge Name</label>
                                                <input type="text" value="<?php echo $book->operation_type;?> Book Charge" name="charge_name" class="form-control">
                                                <input type="hidden" value="<?php echo $charge_id;?>" name="charge_id" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Charge Amount</label>
                                                <input type="text" name="charge_amount" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputAddress">Charge Description</label>
                                                <textarea  name="charge_desc" rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                      <button type="submit" name="charges" class="btn btn-primary mt-3">Add Charge</button>
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