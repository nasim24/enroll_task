<?php

include('connection.php');

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['dob'];
$qualification = $_POST['qualification'];

$resume ="resume/".basename($_FILES['file']['name']);
move_uploaded_file($_FILES['file']['tmp_name'], $resume);

$sql = "INSERT INTO student(fname,lname,dob,qualification,resume) values('$fname','$lname','$dob','$qualification','$resume')";
$res = mysqli_query($connect,$sql);

if(mysqli_error($connect))
{
    echo "Data base error occured";
}
else
{
    echo " Record added to Database";
}

?>