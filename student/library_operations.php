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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Library Operations</span></li>
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
                                            <th>Number</th>
                                            <th>Checksum</th>
                                            <th>Type</th>
                                            <th>Book Isbn Number</th>
                                            <th>Book Title</th>
                                            <th>Book Author</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Get all my library Operations
                                            //Logic->1.Use logged in user session to get operation id
                                            //2. Use operation id to get operation details
                                            $login_id = $_SESSION['login_id'];
                                            $ret="SELECT * FROM students  WHERE student_login_id ='$login_id'"; 
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->execute();
                                            $res=$stmt->get_result();
                                            while($row=$res->fetch_object())
                                            {
                                                $my_id = $row->student_id;
                                            }

                                            $ret="SELECT * FROM student_operations  WHERE student_operation_student_id ='$my_id'"; 
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->execute();
                                            $res=$stmt->get_result();
                                            while($row=$res->fetch_object())
                                            {
                                                $my_operation_id = $row->Student_operation_operation_id;
                                            }

                                            $ret="SELECT * FROM library_operations WHERE operation_id = '$my_operation_id' "; 
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->execute();
                                            $res=$stmt->get_result();
                                            while($ops=$res->fetch_object())
                                            {
                                        ?>
                                            <tr>
                                                <td>
                                                    <span class="badge outline-badge-success">
                                                        <a href="view_operation.php?view=<?php echo $ops->operation_id;?>">
                                                            <?php echo $ops->operation_number;?>
                                                        </a>
                                                    </span>
                                                </td>
                                                <td><?php echo $ops->operation_checksum;?></td>
                                                <td><?php echo $ops->operation_type;?></td>
                                                <td><?php echo $ops->book_isbn_no;?></td>
                                                <td><?php echo $ops->book_title;?></td>
                                                <td><?php echo $ops->book_author;?></td>
                                                <td><?php echo date('d-M-Y', strtotime($ops->created_at));?></td>
                                            </tr>
                                        <?php }?>
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