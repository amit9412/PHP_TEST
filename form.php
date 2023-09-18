<?php
$conn= new mysqli("localhost","root","","formsubmit");
if($conn->connect_error){
    die("connection Failed");
}
if(isset($_POST['submit'])){
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $name=$_POST['name'];
    $mobile=$_POST['$mobile'];
    $email=$_POST['$email'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    $userip=$_SERVER['REMOTE_ADDR'];
    $errors=[];
    if(empty($name))
    {
        $errors[]="Name is required";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $errors[]="invalid Email Formate";
    }
    if(!preg_match("/^\d{10}$/",$phone)){
        $errors[]="phone number is Invalid";
    }
    if(empty($subject))
    {
        $errors[]="Subject is required";
    }
    if(empty($message))
    {
        $errors[]="message is required";
    }
    $sql="SELECT email,mobile FROM contact_form where email=$email OR name=$name ";
    $result=$conn->execute_query($sql);
    if(!empty($result))
    {
        $errors[]='Query already submitted by Mobile no or Email';
    }
    if(empty($errors)){
$sql="INSERT INTO contact_form(name,mobile,email,subject,message,ipaddress) VALUES($name,$mobile,$email,$subject,$message,$userip;";
  $conn->execute_query($sql);
}
}
}
?>
<!DOCTYPE html>
<html> <head>
    <title>Form</title>
</head>
</html><body> 
    <?php $i=0; 
    while(!empty($errors)){
    echo $error[$i]; 
    $i++; 
    }?>
    <form action="#" method="post">
        <label for="Name"> Name</label>
        <input type="text" name="name" required>
        <br><label for="phone number"> phone number</label>
        <input type="text" name="mobile" required>
        <br><label for="Email"> Email</label>
        <input type="text" name="email" required>
        <br> <label> Subject</label>
        <input type="text" name="subject" required>
        <br><label> Message</label>
        <input type="textfield" name="message" required>
    <input type="submit">
    </form>
</body>
</html>
