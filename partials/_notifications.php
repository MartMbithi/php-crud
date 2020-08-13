<?php
    $ret = "SELECT * FROM  library_operations "; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($operation = $res->fetch_object())
    {
        //default profile pic if logged in user has no profile picture
        if($operation->operation_type == 'Borrow')
        {
            echo 
            "
            ";
        }
        else if($operation->operation_type =='Return')
        {
            echo 
            "
            ";
        }
        else if($operation->operation_type == 'Lost')
        {
            echo 
            "
            ";
        }        
        else if($operation->operation_type == 'Damanged')
        { 
            echo 
            "
            ";

        }
        else
        {
            echo 
            "
            ";
        }

    }
  
