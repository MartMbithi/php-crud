<?php
    session_start();
    include('config/config.php');
    include('config/checklogin.php');
    check_login();
    //Delete Librarian Account
    if(isset($_GET['delete']))
    {
          $id=intval($_GET['delete']);
          $adn="DELETE FROM  librarians  WHERE  librarian_id = ?";
          $stmt= $mysqli->prepare($adn);
          $stmt->bind_param('i',$id);
          $stmt->execute();
          $stmt->close();	 
         if($stmt)
         {
             $success = "Deleted" && header("refresh:1; url=manage_librarians.php");
         }
         else
         {
             $err = "Try Again Later";
         }
    }
    //Revoke Login
    if(isset($_GET['revoke_login']))
    {
          $id= $_GET['revoke_login'];
          $adn="DELETE FROM  login  WHERE  login_id = ?";
          $postQuery="UPDATE librarians SET librarian_account_status= 'Denied Login' WHERE librarian_login_id =?";
          $stmt= $mysqli->prepare($adn);
          $postStmt = $mysqli->prepare($postQuery);
          $stmt->bind_param('s', $id);
          $postStmt->bind_param('s', $id);
          $stmt->execute();
          $postStmt->execute();
          $stmt->close();	
          $postStmt->close(); 
         if($stmt && $postStmt)
         {
             $success = "Login Permissions Revoked" && header("refresh:1; url=manage_librarians.php");
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Librarians</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Manage Librarians</span></li>
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
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Account Login Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            //Get all librarians
                                            $ret="SELECT * FROM  librarians"; 
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->execute();
                                            $res=$stmt->get_result();
                                            while($lib=$res->fetch_object())
                                            {

                                        ?>
                                            <tr>
                                                <td><?php echo $lib->librarian_name;?></td>
                                                <td><?php echo $lib->librarian_number;?></td>
                                                <td><?php echo $lib->librarian_email;?></td>
                                                <td><?php echo $lib->librarian_phone_number;?></td>
                                                <td><?php echo $lib->librarian_address;?></td>
                                                <td>
                                                    <?php
                                                        if($lib->librarian_account_status == 'Denied Login')
                                                        {
                                                            echo "<span class='badge outline-badge-danger'>$lib->librarian_account_status</span>";
                                                        }
                                                        else
                                                        {
                                                            echo "<span class='badge outline-badge-success'>$lib->librarian_account_status</span>";
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-dark btn-sm">Manage</button>
                                                        <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                                            <a class="dropdown-item" href="view_librarian.php?view=<?php echo $lib->librarian_id;?>">View</a>
                                                            <a class="dropdown-item" href="update_librarian.php?update=<?php echo $lib->librarian_id;?>">Update</a>
                                                            <?php
                                                                // Deny and Allow Login Permissions Based on Account Status
                                                                if($lib->librarian_account_status == 'Denied Login')
                                                                {
                                                                    echo 
                                                                    "
                                                                        <a class='dropdown-item text-success' href='login_permissions.php?user=$lib->librarian_id'>
                                                                            Give Login Permissions
                                                                        </a>
                                                                    ";
                                                                }
                                                                else
                                                                {
                                                                    echo 
                                                                    "
                                                                        <a class='dropdown-item text-danger' href='manage_librarians.php?revoke_login=$lib->librarian_login_id'>
                                                                            Revoke Login Permissions
                                                                        </a>
                                                                    ";
                                                                }

                                                            ?>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="manage_librarians.php?delete=<?php echo $lib->librarian_id;?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
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