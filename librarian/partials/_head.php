<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Library Management System - Multipurpose Light Weight Library Management System</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico"/>
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link href="assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/dropify/dropify.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link href="plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
    <link href="plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css">
    <script src="assets/js/swal.js"></script>
    <!--Load Swal-->
    <?php if(isset($success)) {?>
    <!--This code for injecting success alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Success","<?php echo $success;?>","success");
                    },
                        100);
                    
        </script>

    <?php } ?>
    <?php if(isset($err)) {?>
    <!--This code for injecting error alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Failed","<?php echo $err;?>","error");
                    },
                        100);
        </script>

    <?php } ?>
    <?php if(isset($info)) {?>
    <!--This code for injecting info alert-->
        <script>
                    setTimeout(function () 
                    { 
                        swal("Success","<?php echo $info;?>","info");
                    },
                        100);
        </script>

    <?php } ?>
    <script>
        function getStudentDetails(val)
        {
            $.ajax({

            type: "POST",
            url: "ajax.php",
            data: 'regNumber='+val,
            success: function(data)
            {
            //alert(data);
            $('#studentName').val(data);
            }
            });

            $.ajax({

                type: "POST",
                url: "ajax.php",
                data:'studentName='+val,
                success: function(data)
                {
                //alert(data);
                $('#StudentID').val(data);
                }
            });
        
        }
    </script>
</head>