<?php

//---------Password Reset Token generator-------------------------------------------//
    $length = 30;
    $tk = substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"),1,$length);
    
//------------Dummy Password Generator----------------------------------------------//
    $length = 10;
    $rc= substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM1234567890"),1,$length);


    //----------System Generated Numbers------------------------------------------//
    $length = 4;
    $alpha= substr(str_shuffle("QWERTYUIOPLKJHGFDSAZXCVBNM"),1,$length);
    $ln = 4;
    $beta = substr(str_shuffle("1234567890"),1,$length);

    $checksum= bin2hex(random_bytes('12'));
    $operation_id = bin2hex(random_bytes('4'));
    $charge_id = bin2hex(random_bytes('6'))
?>