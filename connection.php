<?php
$connect = mysqli_connect('localhost', 'root', '', 'app34');

if (mysqli_connect_errno())
{
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

?>