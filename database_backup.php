<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname='library_management_system';
   
   $backup_file = $dbname . date("Y-m-d-H-i-s") . '.gz';
   $command = "mysqldump --opt -h $dbhost -u $dbuser -p $dbpass ". "test_db | gzip > $backup_file";
   
   system($command);
?>