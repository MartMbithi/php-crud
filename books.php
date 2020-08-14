<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
    //Delete Book
    if(isset($_GET['delete']))
    {
          $category = $_GET['category'];
          $id=intval($_GET['delete']);
          $adn="DELETE FROM  books  WHERE  book_id = ?";
          $stmt= $mysqli->prepare($adn);
          $stmt->bind_param('i',$id);
          $stmt->execute();
          $stmt->close();	 
         if($stmt)
         {
             $success = "Deleted" && header("refresh:1; url=manage_books_per_category.php?category=$category");
         }
         else
         {
             $err = "Try Again Later";
         }
    }
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Reporting</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Books</span></li>
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
                                            <th>ISBN Number</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Publisher</th>
                                            <th>Status</th>
                                            <th>Copies</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Get all Books
                                            $ret="SELECT * FROM books "; 
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->execute();
                                            $res=$stmt->get_result();
                                            while($book=$res->fetch_object())
                                            {
                                        ?>
                                            <tr>
                                                <td>
                                                    <span class="badge outline-badge-success">
                                                        <a href="view_book.php?view=<?php echo $book->book_id;?>">
                                                            <?php echo $book->book_isbn_no;?>
                                                        </a>
                                                    </span>
                                                </td>
                                                <td><?php echo $book->book_title;?></td>
                                                <td><?php echo $book->book_author;?></td>
                                                <td><?php echo $book->book_publisher;?></td>
                                                <td><?php echo $book->book_status;?></td>
                                                <td><?php echo $book->book_copies;?> Copies</td>
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