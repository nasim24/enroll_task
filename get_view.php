<?php
 include('connection.php');
 if(isset($_POST['checking_viewbtn']))
{
    $id = $_POST['student_id'];
    $sql = "select * from student where id='$id'";
    $res = mysqli_query($connect,$sql);

    if(mysqli_num_rows($res)>0)
    {
        foreach($res as $row)
        {
            echo $result = '
                <h5>ID: '.$row['id'].'</h5>
                <h5>Firstname: '.$row['fname'].'</h5>
                <h5>Lastname: '.$row['lname'].'</h5>
                <h5>Dob: '.$row['dob'].'</h5>
                <h5>Qualification: '.$row['qualification'].'</h5>
                <h5>Resume: '.$row['resume'].'</h5>
            ';
        }
    }
    else
    {
        echo $return = "<h5>No Record</h5>";
    }
}

?>