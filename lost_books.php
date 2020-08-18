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
                                <li class="breadcrumb-item active" aria-current="page"><span>Report Lost Book</span></li>
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
            require_once('partials/_sidebar.php');?>
        ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>ISBN Number</th>
                                            <th>Date Borrowed</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //logic use operation id to get book id
                                            $ret="SELECT operation_id, operation_type FROM library_operations WHERE operation_type = 'Borrow'"; 
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->execute();
                                            $res=$stmt->get_result();
                                            while($operation=$res->fetch_object())
                                            {
                                                $op_id = $operation->operation_id;
                                                $ret="SELECT student_operation_book_id, student_operation_start_date   FROM student_operations WHERE Student_operation_operation_id ='$op_id' "; 
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute();
                                                $res=$stmt->get_result();
                                                while($book=$res->fetch_object())
                                                {
                                                    $date = $book->student_operation_start_date;

                                                    $bookid = $book->student_operation_book_id;
                                                    $ret="SELECT *  FROM books WHERE book_id ='$bookid' "; 
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->execute();
                                                    $res=$stmt->get_result();
                                                    while($book=$res->fetch_object())
                                                    {
                                        ?>
                                            <tr>
                                                <td><?php echo $book->book_title;?></td>
                                                <td><?php echo $book->book_author;?></td>
                                                <td><?php echo $book->book_isbn_no;?></td>
                                                <td><?php echo $date;?></td>
                                                <td>
                                                    <a href="student_lost_book.php?book=<?php echo $book->book_isbn_no;?>&id=<?php echo $op_id;?>" class="badge outline-badge-danger text-danger bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Report Lost <?php echo $book->book_title;?>">
                                                        Report Lost Book
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>                                                         
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>                                                   
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }}}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <?php require_once('partials/_footer.php');?>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
    <?php require_once('partials/_scripts.php');?>    
</body>

</html>