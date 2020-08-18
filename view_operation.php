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
        $view = $_GET['view'];
        $ret="SELECT * FROM library_operations WHERE operation_id = '$view'"; 
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
                    if($book->book_coverimage == '')
                    {
                        $cover ="<img src='assets/img/book_category.jpg' class='img-thumbnail img-fluid'  alt='avatar'>";
                    }
                    else
                    {
                        $cover="<img src='assets/img/books/$book->book_coverimage' class='img-thumbnail img-fluid'  alt='avatar'>";
                    }

            
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Manage Operations</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">View</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span><?php echo $operation->operation_checksum;?></span></li>
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

                <div class="row layout-spacing">

                    <!-- Content -->
                    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between">
                                    <h3 class=""><?php echo $book->book_title;?></h3>
                                </div>
                                <div class="text-center user-info">
                                    <?php echo $cover;?>
                                    <p class="">Operation Type : <?php echo $operation->operation_type;?> Book</p>
                                </div>
                                <div class="user-info-list">
                                    <div class="">
                                    <div class="">
                                        <ul class="contacts-block list-unstyled">
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>                                                
                                                Author : <?php echo $book->book_author;?>
                                            </li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>                                                 
                                               ISBN No:  <?php echo $book->book_isbn_no;?>
                                            </li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="16 16 12 12 8 16"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path><polyline points="16 16 12 12 8 16"></polyline></svg>                                                 
                                                Operation Checksum: <?php echo $operation->operation_checksum;?>
                                            </li>
                                        </ul>
                                    </div>         
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">
                        <div class="bio layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">Operation Description</h3>
                                <p>
                                    <?php
                                        echo $operation->operation_desc;
                                    ?>
                                </p>
                            </div>                                
                        </div>
                    </div>

                </div>
            </div>
            <?php require_once('partials/_footer.php');?>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <?php require_once('partials/_scripts.php'); }}}?>    
</body>

</html>