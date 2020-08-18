<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
    
        if(isset($_POST['book']))
        {
            //Prevent Posting Blank Values
            if (empty($_POST['book_title']) || empty($_POST['book_author']) || empty($_POST['book_isbn_no']) || empty($_POST['book_publisher'])  || empty($_POST['book_copies'])) 
            {
                $err="Blank Values Not Accepted";
            }
            else
            {  
                $update = $_GET['update'];
                $book_title = $_POST['book_title'];
                $book_author = $_POST['book_author'];
                $book_isbn_no = $_POST['book_isbn_no'];
                $book_publisher = $_POST['book_publisher'];
                $book_coverimage = $_FILES['book_coverimage']['name'];
                move_uploaded_file($_FILES["book_coverimage"]["tmp_name"],"assets/img/books/".$_FILES["book_coverimage"]["name"]);
                $book_status = $_POST['book_status'];
                $book_summary = $_POST['book_summary'];
                $book_copies = $_POST['book_copies'];
                     
                //Insert Captured information to a database table
                $postQuery="UPDATE  books SET book_publisher =?, book_title =?, book_author =?, book_isbn_no =?, book_coverimage =?, book_status =?, book_summary =?, book_copies =? WHERE book_id  =?";
                $postStmt = $mysqli->prepare($postQuery);
                //bind paramaters
                $rc=$postStmt->bind_param('ssssssssi', $book_publisher, $book_title, $book_author, $book_isbn_no, $book_coverimage, $book_status, $book_summary, $book_copies, $update);
                $postStmt->execute();
                //declare a varible which will be passed to alert function
                if($postStmt)
                {
                    $success = "Book Updated" && header("refresh:1; url=view_book.php?view=$update");
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
        $update = $_GET['update'];
        $ret="SELECT * FROM books  WHERE book_id = '$update' "; 
        $stmt= $mysqli->prepare($ret) ;
        $stmt->execute();
        $res=$stmt->get_result();
        while($book=$res->fetch_object())
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Books</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Manage Books</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Update Book</a></li>
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
                                                <label for="inputEmail4">Book Title</label>
                                                <input type="text" name="book_title" value="<?php echo $book->book_title;?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Book ISN Number</label>
                                                <input type="text" name="book_isbn_no" value="<?php echo $book->book_isbn_no;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-6">
                                                <label for="inputEmail4">Book Author</label>
                                                <input type="text" name="book_author" value="<?php echo $book->book_author;?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputPassword4">Book Publisher</label>
                                                <input type="text" name="book_publisher" value="<?php echo $book->book_publisher;?>"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Book Cover Image</label>
                                                <input type="file" name="book_coverimage" data-default-file="<?php echo $book->book_coverimage;?>" class="form-control btn btn-outline-success">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputEmail4">Book Status</label>
                                                <input type="text" name="book_status" value="<?php echo $book->book_status;?>"" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="inputPassword4">Book Copies</label>
                                                <input type="text" name="book_copies" value="<?php echo $book->book_copies;?>"  class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row mb-4">
                                            <div class="form-group col-md-12">
                                                <label for="inputAddress">Book Summary</label>
                                                <textarea  name="book_summary" rows="10" class="form-control"><?php echo $book->book_summary;?></textarea>
                                            </div>
                                        </div>
                                      <button type="submit" name="book" class="btn btn-primary mt-3">Update Book</button>
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