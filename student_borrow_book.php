<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
    
        if(isset($_POST['BorrowBook']))
        {
            $operation_number = $_POST['operation_number'];
            $operation_checksum  = $_POST['operation_checksum'];
            $operation_type = $_POST['operation_type'];
            $operation_desc = $_POST['operation_desc'];
            $operation_id = $_POST['operation_id'];

            //Handle Foregn Keys
            $student_operation_student_id = $_POST['student_operation_student_id'];
            $book = $_GET['book'];
            $student_operation_start_date = $_POST['student_operation_start_date'];
            $student_operation_end_date = $_POST['student_operation_end_date'];
                    
            //Book Copies
            $book_copies = $_POST['book_copies'];

            //Insert Captured information to a database table
            $postQuery="INSERT INTO library_operations ( operation_id,  operation_number, operation_checksum, operation_type, operation_desc) VALUES(?,?,?,?,?)";
            $foregnQry = "INSERT INTO student_operations(student_operation_student_id, student_operation_book_id, student_operation_start_date, student_operation_end_date, Student_operation_operation_id) VALUES(?,?,?,?,?)";
            $bookQry = "UPDATE books SET book_copies =? WHERE book_id = ?";

            //Prepare 
            $postStmt = $mysqli->prepare($postQuery);
            $foregnStmt = $mysqli->prepare($foregnQry);
            $bookStmt = $mysqli->prepare($bookQry);

            //bind paramaters
            $rc=$postStmt->bind_param('sssss', $operation_id, $operation_number, $operation_checksum, $operation_type, $operation_desc);
            $rc = $foregnStmt->bind_param('iisss', $student_operation_student_id, $book, $student_operation_start_date, $student_operation_end_date, $operation_id);
            $rc = $bookStmt->bind_param('si', $book_copies, $book);
            $postStmt->execute();
            $foregnStmt->execute();
            $bookStmt->execute();
            //declare a varible which will be passed to alert function
            if($postStmt && $foregnStmt && $bookStmt)
            {
                $success = "Book Borrowed" && header("refresh:1; url=borrow_book.php");
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
        $ret="SELECT * FROM books WHERE book_id = '$book' "; 
        $stmt= $mysqli->prepare($ret) ;
        $stmt->execute();
        $res=$stmt->get_result();
        while($book=$res->fetch_object())
        {
            $initialBookCount = $book->book_copies;
            $newBookCount = $initialBookCount - 1 ;
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Borrow Book</a></li>
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
                                                <input type="hidden" name="operation_status" required value="1" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Library Operation Checksum</label>
                                                <input type="text" name="operation_checksum" value="<?php echo $checksum;?>" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-md-6" style="display:none">
                                                <label for="inputPassword4">Library Category</label>
                                                <input type="text" name="operation_type" value="Borrow" readonly class="form-control">
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
                                            <div class="form-group col-md-6" style="display:none">
                                                <label>Remaining Book Copies</label>
                                                <input type="text" value="<?php echo $newBookCount;?>" required name="book_copies" class="md-input"  />
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Registration Number</label>
                                                <select name="" id ="regNumber" onChange="getStudentDetails(this.value)" class="form-control  basic">
                                                    <option selected="selected">Select Reg Number</option>
                                                    <?php
                                                        $ret="SELECT * FROM  students"; 
                                                        $stmt= $mysqli->prepare($ret) ;
                                                        $stmt->execute();
                                                        $res=$stmt->get_result();
                                                        while($std=$res->fetch_object())
                                                        {
                                                        
                                                    ?>
                                                        <option><?php echo $std->student_reg_number;?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Student Name</label>
                                                <input type="text" name="" id ="studentName" readonly class="form-control">
                                            </div>
                                            <div class="form-group col-md-6" style="display:none;">
                                                <label for="inputPassword4">Student ID</label>
                                                <input type="text" name="student_operation_student_id" id="StudentID" readonly class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Date Borrowed</label>
                                                <input type="text" value="<?php echo date('m-d-Y');?>" name="student_operation_start_date"   class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Return Date</label>
                                                <input type="date" required name="student_operation_end_date"   class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputAddress">Description</label>
                                                <textarea  name="operation_desc"  rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                      <button type="submit" name="BorrowBook" class="btn btn-primary mt-3">Borrow Book</button>
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