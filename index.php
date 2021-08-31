<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.esm.min.js"></script>
</head>
<body>

<!-- Personal Details -->
   <!-- Form Started -->
   <div class="container mt-4">
        <div class="col-sm-12 ">
        <h4 class="text-center text-light bg-dark mb-3">Add Entrollment Details</h4>    
        <form id="submit_form">
            <div class="row">                
                <div class="col-sm-9">                
                        <div class="form-row">
                            <label for="" class="col-md-2">FIRSTNAME</label>
                            <input type="text" class="form-control col-md-10" name="fname" placeholder="Enter Your Firstname" required>
                        </div>
                        <div class="form-row mt-3">
                            <label for="" class="col-md-2">LASTNAME</label>
                            <input type="text" class="form-control col-md-10" name="lname" placeholder="Enter Your Lastname" required>
                        </div>
                        <div class="form-row mt-3">
                            <label for="" class="col-md-2">DOB</label>
                            <input type="text" id="datepicker" class="form-control col-md-10" name="dob" required>
                        </div>
                        
                        <div class="form-row mt-3">
                            <label for="" class="col-md-2">Qualification</label>
                           <select name="qualification" id="" required>
                               <option value="">Select Option</option>
                               <option value="UG">UG</option>
                               <option value="PG">PG</option>
                           </select>
                        </div>

                        <div class="form-row mt-3" required>
                            <label for="" class="col-md-2">Upload Resume</label>
                            <input type="file" class="form-control col-md-10" name="file" required>                            
                        </div>
                
                </div>                
            </div>
            <input type="submit" name="upload_button" id="upload_btn" class="btn btn-info d-block mx-auto mt-4" value="Submit" />  
            </form>


<!-- Record section -->
<?php
include('connection.php');
$sql="select * from student";
$res=mysqli_query($connect,$sql);

?>
<div class="mt-5 mb-5">
        <h4 class="text-center text-light bg-dark mb-3">Student Details</h4>        
            <table class="table table-bordered" >                
            <thead>
                <tr>
                    <th>SNO</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>DOB</th>
                    <th>Qualification</th>
                    <th>Resume</th>
                    <th>Action</th>
                </tr>
            </thead>
               <tbody>
                   <?php 
                      
                        foreach($res as $row)
                        {
                            $id=$row['id'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $dob = $row['dob'];
                            $qualification = $row['qualification'];
                            $resume = $row['resume'];
        
                   ?>
                    <tr>
                        <td class="stud_id"><?php echo $id;?></td>
                        <td><?php echo $fname;?></td> 
                        <td><?php echo $lname;?></td> 
                        <td><?php echo $dob;?></td> 
                        <td><?php echo $qualification;?></td> 
                        <td><?php echo $resume;?></td>                            
                        <td><a href="#" data-toggle="modal" class="open-dialog btn btn-primary btn-xs view_btn" >view</a></td>
                    </tr>
                    <?php }?>
               </tbody>
            </table>
        
    </div>

    <script>
        $(document).ready(function(){
            
            $("#submit_form").on("submit", function(e){
            e.preventDefault();
            
            $('#datepicker').datepicker({
                format: "dd/mm/yyyy",
                autoclose: true,
                orientation: "top",
                endDate: "today",
                maxDate: 0 
            });
                var formData = new FormData(this);
                $.ajax({
                    url: "empstore.php",
                    type : "POST",
                    data : formData,
                    contentType : false,
                    processData: false,
                    success:function(data)
                    {
                        alert(data);
                        $('#submit_form')[0].reset();
                    }
                });
            });

            // on click view button

            $('.view_btn').click(function (e)
            {
                e.preventDefault();
                var stud_id = $(this).closest('tr').find('.stud_id').text();
                $.ajax({
                    type:"POST",
                    url:"get_view.php",
                    data:{'checking_viewbtn':true, 'student_id':stud_id},
                    success:function(data)
                    {
                        $('.resultdata').html(data);
                        $('#exampleModal').modal('show');
                    }
                });

             


            });


        });
    </script>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="resultdata">

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    
</body>
</html>