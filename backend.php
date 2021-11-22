<?php

$conn = mysqli_connect('localhost','root',"",'employeedb');

extract($_POST);

if(isset($_POST['readrecord']))
{

  $data ='<table class="table table-bordered table-stripted">
              <tr>
                 <th>No</th>
                  <th>First Name.</th>
                    <th>Last Name.</th>
                   <th>Email</th>
                  <th>Mobile</th>
                 <th>Edit Action</th>
              <th>Delete Action</th>




  </tr>';
  $displayquery = "SELECT * FROM admin";

  $result = mysqli_query($conn,$displayquery);

  if(mysqli_num_rows($result)>0){

    $number  = 1;

    while($row = mysqli_fetch_array($result)){
      $data .='<tr>
      <td>'.$number.'</td>
      <td>'.$row['firstname'].'</td>
      <td>'.$row['lastname'].'</td>
      <td>'.$row['email'].'</td>
      <td>'.$row['mobile'].'</td>
      <td>
          <button onclick="GetUserDetails('.$row['id'].')" class="btn btn-success">Edit</button>

       </td>
      <td>
            <button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
       </td>
      </tr>';
      
      $number++;
  }
}
  $data .= '</table>';
    echo $data;
}

if(isset($_POST['firstname']) && isset($_POST['lastname'])&& isset($_POST['email']) && isset($_POST['mobile']))

{
 // if($firstname!='' && $lastname!='' && $email!='' $mobile!=''){

  $query = "INSERT INTO admin(fname, lname, email, mobile) VALUES ('$firstname','$lastname', '$email', '$mobile')";

  mysqli_query($conn,$query);

  
  
}
///delete user record

if(isset($_POST['deleteid']))
  {
    $userid = $_POST['deleteid'];

    $deletequery = "DELETE FROM admin  WHERE id='$userid' ";

    mysqli_query($conn,$deletequery);

  }


/////get userid for update
  
if(isset($_POST['id']) && isset($_POST['id'])!="")
{


  $user_id = $_POST['id'];

  $query = "SELECT  * FROM admin WHERE id = '$user_id' ";

  if(!$result = mysqli_query($conn,$query)){
    exit(mysqli_query());
  }
      $response = array();

      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){

          $response = $row;

        }
      }
        
        echo json_encode($response);
   }   


if(isset($_POST['update_firstname']) && isset($_POST['update_lastname'])&& isset($_POST['update_email']) && isset($_POST['update_mobile']) && isset($_POST['hidden_user_id']))

{
  $query = "UPDATE admin SET firstname='".$update_firstname."', lastname='".$update_lastname."', email='".$update_email."', mobile='".$update_mobile."' WHERE id='".$_POST['hidden_user_id']."' ";

  mysqli_query($conn,$query);
}
?>