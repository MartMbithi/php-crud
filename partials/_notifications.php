<?php
    $ret = "SELECT * FROM  library_operations ORDER BY `library_operations`.`created_at` DESC"; 
    $stmt = $mysqli->prepare($ret) ;
    $stmt->execute() ;
    $res = $stmt->get_result();
    while($operation = $res->fetch_object())
    {
        //Strip timestamp to DD-MM-YYYY H:M Formart
        $date = date('d-M-Y g:i', strtotime($operation->created_at));
        if($operation->operation_type == 'Borrow')
        {
            echo 
            "
                <div class='item-timeline timeline-new'>
                    <div class='t-dot'>
                        <div class='t-primary'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg></div>
                    </div>
                    <div class='t-content'>
                        <div class='t-uppercontent'>
                            <h6>$operation_type</h6>
                        </div>
                        $operation->book_title <br> $operation->book_isbn_no
                        <div class='tags'>
                            <div class='badge badge-primary'>$date</div>
                        </div>
                    </div>
                </div>
            ";
        }
        else if($operation->operation_type =='Return')
        {
            echo 
            "
                <div class='item-timeline timeline-new'>
                    <div class='t-dot'>
                        <div class='t-success'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg></div>
                    </div>
                    <div class='t-content'>
                        <div class='t-uppercontent'>
                        <h6>$operation->operation_type</h6>
                        </div>
                        $operation->book_title <br> $operation->book_isbn_no
                        <div class='tags'>
                            <div class='badge badge-success'>$date</div>
                        </div>
                    </div>
                </div>
            ";
        }
        else if($operation->operation_type == 'Lost')
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
                            <h6>$operation->operation_type</h6>
                        </div>
                        $operation->book_title <br> $operation->book_isbn_no
                        <div class='tags'>
                            <div class='badge badge-danger'>$date</div>
                        </div>
                    </div>
                </div>
            ";
        }        
        else if($operation->operation_type == 'Damanged')
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
                        <h6>$operation->operation_type</h6>
                    </div>
                    $operation->book_title <br> $operation->book_isbn_no
                    <div class='tags'>
                        <div class='badge badge-warning'>$date</div>
                    </div>
                </div>
            </div>
            ";

        }
        else
        {
            echo 
            "
            <div class='item-timeline timeline-new'>
                <div class='t-dot'>
                    <div class='t-primary'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg></div>
                </div>
                <div class='t-content'>
                    <div class='t-uppercontent'>
                    <h6>$operation->operation_type</h6>
                    </div>
                    $operation->book_title <br> $operation->book_isbn_no
                    <div class='tags'>
                        <div class='badge badge-primary'>$date</div>
                    </div>
                </div>
            </div>
            ";
        }

    }
  
