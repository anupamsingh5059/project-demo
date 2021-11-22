<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
</head>
<body>
  <div class="container">
    <h1 class="text-primary text-uppercase text-center">AJAX CRUD OPERATION</h1>
    <div class="d-flex justify-content-end">
  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
  Add_Records 
</button>

</div>
<h2 class="text-danger">All Records</h2>
<div id="records_contant">
  
</div>
<!-- //////the modal
 -->
 <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
       <label for="firstname">First NAME:</label>
       <input type="text" name="" id="firstname" class="form-control" placeholder="First Name">
         
       </div>
        <div class="form-group">
       <label for="lastname">Last NAME:</label>
       <input type="text" name="" id="lastname" class="form-control" placeholder="Last Name">
         
       </div>
        <div class="form-group">
       <label for="Email">Email:</label>
       <input type="email" name="" id="email" class="form-control" placeholder="Email">
         </div>
  
        <div class="form-group">
       <label for="mobile">Mobile:</label>
       <input type="mobile" name="" id="mobile" class="form-control" placeholder="mobile Number">
         
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">Save</button >
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>

  </div>
</div>


<!--  //// update modal .......... -->

<div class="modal" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
       <label for="update_firstname">First NAME:</label>
       <input type="text" name="" id="update_firstname" class="form-control" placeholder="First Name">
         
       </div>
        <div class="form-group">
       <label for="update_lastname">Last NAME:</label>
       <input type="text" name="" id="update_lastname" class="form-control" placeholder="Last Name">
         
       </div>
        <div class="form-group">
       <label for="update_email">Email:</label>
       <input type="email" name="" id="update_email" class="form-control" placeholder="Email">
         </div>
  
        <div class="form-group">
       <label for="update_mobile">Mobile:</label>
       <input type="mobile" name="" id="update_mobile" class="form-control" placeholder="mobile Number">
         
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="updateuserdetail()">Update</button >
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <input type="hidden" name="" id="hidden_user_id">
      </div>

    </div>
    
  </div>

</div>
  </div>

  
  

    
  

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  
  <script type="text/javascript">


    $(document).ready(function(){
      readRecords();
    });

  function readRecords(){
     var readrecord = "readrecord";
     $.ajax({
           
           url:"backend.php",
           type: "POST",
           data:{readrecord:readrecord },
           success:function(data,status){
           // alert(readrecord);
            $('#records_contant').html(data);
           }

     });

  }


    
function updateuserdetail(){

  var update_firstname = $('#update_firstname').val();
  var update_lastname = $('#update_lastname').val();
  var  update_email= $('#update_email').val();

  var update_mobile = $('#update_mobile').val();
  var hidden_user_id = $('#hidden_user_id').val();
//( mobile);
     $.ajax({
     
     url:"backend.php",
     type:'POST',
     data:{update_firstname : update_firstname,
            update_lastname : update_lastname,
             update_email :   update_email,
             update_mobile :  update_mobile,
             hidden_user_id: hidden_user_id
             },
             success:function(data){
             // alert(data); 
              alert('Data Updated....');
              readRecords();
             }

  }); 
   }

   ///Delete records call

   function DeleteUser(deleteid){

   var conf = confirm("Are You Sure To Delete Data");
   if(conf==true){

      $.ajax({
           url:"backend.php",
           type: "POST",
          data:{deleteid:deleteid},
            success:function(data,status){
              readRecords();
          }
       });
     }
}


function GetUserDetails(id){

  // alert(id);
  $('#hidden_user_id').val(id);

  $.ajax({
           url:"backend.php",
           type: "POST",
          data:{id:id},
          dataType: "json",
            success:function(data){
              $('#update_firstname').val(data.firstname);
              $('#update_lastname').val(data.lastname);
              $('#update_email').val(data.email);
              $('#update_mobile').val(data.mobile);
          }
       });

    $('#update_user_modal').modal("show");
}






   function addRecord(){

  var firstname = $('#firstname').val();
  var lastname = $('#lastname').val();
  var  email= $('#email').val();

  var mobile = $('#mobile').val();
//( mobile);
     $.ajax({
     
     url:"backend.php",
     type:'POST',
     data:{firstname : firstname,
            lastname : lastname,
             email :   email,
             mobile :  mobile
             },
             success:function(data,status){ 
              alert('Data Inserted Into Database');
              readRecords();
             }

  }); 
   }




  </script>

</body>
</html>