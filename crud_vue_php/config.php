<?php

 $conn= new mysqli("localhost","root","","crud_vue");
 if($conn->connect_error){
     die("Connection Failed".$conn->connect_error);
 }

 $result= array('error'=>false);
 $action='';
 if(isset($_GET['action']))
 {
     $action = $_GET['action'];
 }

 if($action=='read'){
     $sql =$conn->query("SELECT * FROM users");
     $users= array();
     while($row =$sql->fetch_assoc()){
         array_push($users,$row);
     }
     $result['users']=$users;
 }
 
 if($action=='create'){
     $firstname=$_POST['firstname'];
     $lastname=$_POST['lastname'];
     $phone=$_POST['phone'];
     $email=$_POST['email'];
     $employeid=$_POST['employeid'];
     

       
      
    $sql =$conn->query("INSERT INTO users (firstname,lastname,phone,email,employeid) VALUE('$firstname','$lastname','$phone','$email','$employeid')");
    if($sql){
        $result['message']="added successfully";
    }
    else{
        $result['error']=true;
        $result['message']="Faid to add user";
    }
}


if($action=='update'){
    $id = $_POST['id'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $employeid=$_POST['employeid'];
   $sql =$conn->query("UPDATE users SET firstname='$firstname',lastname='$lastname',phone='$phone',email='$email',employeid='$employeid' WHERE id = '$id'");
   if($sql){
       $result['message']="updated successfully";
   }
   else{
       $result['error']=true;
       $result['message']="Faid to update user";
   }
}


if($action=='delete'){
    $id = $_POST['id'];
   $sql =$conn->query("DELETE FROM users  WHERE id = '$id'");
   if($sql){
       $result['message']="deleted successfully";
   }
   else{
       $result['error']=true;
       $result['message']="Faid to delete user";
   }
}
$conn->close();
 echo json_encode($result);
?>