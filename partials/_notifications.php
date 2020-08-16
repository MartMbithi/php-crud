<?php

    /*
    Operation Logic
    1. get operation id
    2. use operation id to get book id
    3. get book id to get book details
    */

    $ret = "SELECT * FROM  library_operations WHERE operation_type='Borrow' "; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($operation = $res->fetch_object())
    {
      $borrow_id = $operation->operation_id;
      $date = date('d/M/Y g:i', strtotime($operation->created_at));
    }

    $ret = "SELECT * FROM  library_operations WHERE operation_type='Return' "; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($operation = $res->fetch_object())
    {
      $return_id = $operation->operation_id;
    }

    $ret = "SELECT * FROM  library_operations WHERE operation_type='Damanged' "; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($operation = $res->fetch_object())
    {
      $damanged_id = $operation->operation_id;
    }

    $ret = "SELECT * FROM  library_operations WHERE operation_type='Lost' "; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($operation = $res->fetch_object())
    {
      $lost_id = $operation->operation_id;
    }

    //Use this operation ids on students operation to borrowed book get book id
    $ret = "SELECT * FROM  student_operations WHERE Student_operation_operation_id  = '$borrow_id'"; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($ops = $res->fetch_object())
    {
      $borrowed_book_id = $ops->student_operation_book_id;
    }

    //Use this operation ids on students operation to get returned book id
    $ret = "SELECT * FROM  student_operations WHERE Student_operation_operation_id  = '$return_id'"; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($ops = $res->fetch_object())
    {
        $returned_book_id = $ops->student_operation_book_id;
    }

    //Use this operation ids on students operation to get Lost  book id
    $ret = "SELECT * FROM  student_operations WHERE Student_operation_operation_id  = '$lost_id'"; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($ops = $res->fetch_object())
    {
        $lost_book_id = $ops->student_operation_book_id;
    }

    //Use this operation ids on students operation to get Damanged  book id
    $ret = "SELECT * FROM  student_operations WHERE Student_operation_operation_id  = '$damanged_id'"; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($ops = $res->fetch_object())
    {
        $damanged_book_id = $ops->student_operation_book_id;
    }
    
    
    $ret = "SELECT * FROM  books"; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($book = $res->fetch_object())
    {
        //Strip timestamp to DD-MM-YYYY H:M Formart
        if($book->book_id == $borrowed_book_id)
        {
            echo 
            "
                <div class='item-timeline timeline-new'>
                    <div class='t-dot'>
                        <div class='t-primary'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg></div>
                    </div>
                    <div class='t-content'>
                        <div class='t-uppercontent'>
                            <h6>Borrowed Book</h6>
                        </div>
                        $book->book_title <br> $book->book_isbn_no
                        <div class='tags'>
                            <div class='badge badge-primary'>$date</div>
                        </div>
                    </div>
                </div>
            ";
        }
        else if($book->book_id == $returned_book_id)
        {
            echo 
            "
                <div class='item-timeline timeline-new'>
                    <div class='t-dot'>
                        <div class='t-success'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg></div>
                    </div>
                    <div class='t-content'>
                        <div class='t-uppercontent'>
                        <h6>Returned Book</h6>
                        </div>
                        $book->book_title <br> $book->book_isbn_no
                        <div class='tags'>
                            <div class='badge badge-success'>$date</div>
                        </div>
                    </div>
                </div>
            ";
        }
        else if($book->book_id == $lost_book_id)
        {
            echo 
            "
                <div class='item-timeline timeline-new'>
                    <div class='t-dot'>
                        <div class='t-danger'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-activity'><path d='M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z'></path><line x1='12' y1='9' x2='12' y2='13'></line><line x1='12' y1='17' x2='12' y2='17'></line></svg>                         
                        </div>
                    </div>
                    <div class='t-content'>
                        <div class='t-uppercontent'>
                            <h6>Lost Book</h6>
                        </div>
                        $book->book_title <br> $book->book_isbn_no
                        <div class='tags'>
                            <div class='badge badge-danger'>$date</div>
                        </div>
                    </div>
                </div>
            ";
        }        
        else if($book->book_id == $damanged_book_id)
        { 
            echo 
            "
            <div class='item-timeline timeline-new'>
                <div class='t-dot'>
                    <div class='t-warning'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-activity'><circle cx='12' cy='12' r='10'></circle><line x1='12' y1='8' x2='12' y2='12'></line><line x1='12' y1='16' x2='12' y2='16'></line></svg>                     
                    </div>
                </div>
                <div class='t-content'>
                    <div class='t-uppercontent'>
                        <h6>Damanged Book</h6>
                    </div>
                    $book->book_title <br> $book->book_isbn_no
                    <div class='tags'>
                        <div class='badge badge-warning'>$date</div>
                    </div>
                </div>
            </div>
            ";

        }
        else
        {
            //Silence is the best answer 🎓 
        }

    }
  
