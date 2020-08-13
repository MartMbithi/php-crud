<?php
    $ret = "SELECT * FROM  library_operations "; 
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
                            <h5>Borrow Book</h5>
                            <span class=''>$date</span>
                        </div>
                        <p>$row->operation_desc</p>
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
                            <h5>Return Book</h5>
                            <span class=''>$date</span>
                        </div>
                        <p>$row->operation_desc</p>
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
                        <div class='t-danger'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg></div>
                    </div>
                    <div class='t-content'>
                        <div class='t-uppercontent'>
                            <h5>Lost Book</h5>
                            <span class=''>$date</span>
                        </div>
                        <p>$row->operation_desc</p>
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
                    <div class='t-warning'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg></div>
                </div>
                <div class='t-content'>
                    <div class='t-uppercontent'>
                        <h5>Damanaged Book</h5>
                        <span class=''>$date</span>
                    </div>
                    <p>$row->operation_desc</p>
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
                        <h5>Other</h5>
                        <span class=''>$date</span>
                    </div>
                    <p>$row->operation_desc</p>
                </div>
            </div>
            ";
        }

    }
  
