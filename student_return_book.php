<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
    
        if(isset($_POST['returnBook']))
        {
            $operation_type = $_POST['operation_type'];
            $id = $_GET['id'];

            //Handle Foregn Keys
            $student_operation_student_id = $_POST['student_operation_student_id'];
            $student_operation_book_id = $_POST['student_operation_book_id'];
            $student_operation_start_date = $_POST['student_operation_start_date'];
            $student_operation_end_date = $_POST['student_operation_end_date'];
                    
            //Book Copies
            $book_copies = $_POST['book_copies'];
            $book = $_GET['book'];

            //Insert Captured information to a database table
            $postQuery="UPDATE library_operations SET  operation_type='Return' WHERE operation_id ='$id'";
            $foregnQry = "INSERT student_operations(student_operation_student_id, student_operation_book_id, student_operation_start_date, student_operation_end_date, Student_operation_operation_id) VALUES(?,?,?,?,?)";
            $bookQry = "UPDATE books SET book_copies =? WHERE book_isbn_no = ?";

            //Prepare 
            $postStmt = $mysqli->prepare($postQuery);
            $foregnStmt = $mysqli->prepare($foregnQry);
            $bookStmt = $mysqli->prepare($bookQry);

            //bind paramaters
            //$rc=$postStmt->bind_param('ss', $operation_type, $id);
            $rc = $foregnStmt->bind_param('iisss', $student_operation_student_id, $student_operation_book_id, $student_operation_start_date, $student_operation_end_date, $id);
            $rc = $bookStmt->bind_param('ss', $book_copies, $book);
            
            $postStmt->execute();
            $foregnStmt->execute();
            $bookStmt->execute();
            //declare a varible which will be passed to alert function
            if($postStmt && $foregnStmt && $bookStmt)
            {
                $success = "Book Returned" && header("refresh:1; url=return_book.php");
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
        $book = $_GET['book'];
        $ret="SELECT * FROM books WHERE book_isbn_no = '$book' "; 
        $stmt= $mysqli->prepare($ret) ;
        $stmt->execute();
        $res=$stmt->get_result();
        while($book=$res->fetch_object())
        {
            $initialBookCount = $book->book_copies;
            $newBookCount = $initialBookCount + 1 ;
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Library Operations</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Return Book</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span><?php echo $book->book_title;?></span></li>
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
                                                <label for="inputEmail4">Library Operation Number</label>
                                                <input type="text" name="operation_number" required value="LMS-<?php echo $alpha;?>-<?php echo $beta;?>" class="form-control">
                                                <input type="hidden" name="operation_status" required value="2" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Library Operation Checksum</label>
                                                <input type="text" name="operation_checksum" value="<?php echo $checksum;?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-md-6" style="display:none">
                                                <label for="inputPassword4">Library Category</label>
                                                <input type="text" name="operation_type" value="Return" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-md-6" style="display:none">
                                                <label for="inputPassword4">Operation ID</label>
                                                <input type="text" name="operation_id" value="<?php echo $operation_id;?>" readonly class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Book Title</label>
                                                <input type="text" name="book_title" value="<?php echo $book->book_title;?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Book ISBN Number</label>
                                                <input type="text" name="book_isbn_no" value="<?php echo $book->book_isbn_no;?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Book Author</label>
                                                <input type="text" name="book_author" value="<?php echo $book->book_author;?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-md-4" style="display:none">
                                                <label for="inputPassword4">Book ID</label>
                                                <input type="text" name="student_operation_book_id" value="<?php echo $book->book_id;?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-md-6" style="display:none">
                                                <label>Remaining Book Copies</label>
                                                <input type="text" value="<?php echo $newBookCount;?>" required name="book_copies" class="md-input"  />
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Student Registration Number</label>
                                                <?php
                                                    $id = $_GET['id'];
                                                    $ret="SELECT * FROM  student_operations WHERE Student_operation_operation_id = '$id'"; 
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute();
                                                    $res=$stmt->get_result();
                                                    while($std=$res->fetch_object())
                                                    {
                                                        $student_id = $std->student_operation_student_id;
                                                    }
                                                    $ret="SELECT * FROM  students WHERE student_id = '$student_id'"; 
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute();
                                                    $res=$stmt->get_result();
                                                    while($std=$res->fetch_object())
                                                    {

                                                ?>
                                                    <input type="text" name="student_reg_number" readonly value="<?php echo $std->student_reg_number;?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Student Name</label>
                                                <input type="text" name="student_name" value="<?php echo $std->student_name;?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-md-6" style="display:none;">
                                                <label for="inputPassword4">Student ID</label>
                                                <input type="text" name="student_operation_student_id" value="<?php echo $student_id;?>" readonly class="form-control">
                                            </div>
                                            <?php }
                                            
                                                $id = $_GET['id'];
                                                $ret="SELECT * FROM  student_operations WHERE Student_operation_operation_id = '$id'"; 
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute();
                                                $res=$stmt->get_result();
                                                while($std=$res->fetch_object())
                                                {
                                            ?>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Date Borrowed</label>
                                                <input type="text" value="<?php echo $std->student_operation_start_date;?>" name="student_operation_start_date"   class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Return Date</label>
                                                <input type="text" value="<?php echo $std->student_operation_end_date;?>" required name="student_operation_end_date"   class="form-control">
                                            </div>
                                        </div>
                                      <button type="submit" name="returnBook" class="btn btn-primary mt-3">Return Book</button>
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
    <?php require_once('partials/_scripts.php');}} ?>   
</body>

</html>