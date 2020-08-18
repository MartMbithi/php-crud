<?php
include('config/pdoconfig.php');

if(!empty($_POST["regNumber"])) 
{
    $id=$_POST['regNumber'];
    $stmt = $DB_con->prepare("SELECT * FROM  students WHERE student_reg_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<?php echo htmlentities($row['student_name']); ?>
<?php
}
}


if(!empty($_POST["studentName"])) 
{
    $id=$_POST['studentName'];
    $stmt = $DB_con->prepare("SELECT * FROM  students WHERE student_reg_number = :id");
    $stmt->execute(array(':id' => $id));
?>
<?php
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
?>
<?php echo htmlentities($row['student_id']); ?>
<?php
}
}