<?php
include "_dbconnect.php";
$signup=false;
$userExist=false;
$passMatch=false;



if($_SERVER['REQUEST_METHOD']=="POST")
{
$email = $_POST['signupEmail'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
if ($password==$cpassword)
{
    $existSql="SELECT * FROM `user` WHERE user_email='$email'";
    $result=mysqli_query($conn,$existSql);
    $num = mysqli_num_rows($result);
   

    if($num>0)
    {
        
        header("Location: /forum\index.php?userExist=true");
    }
    else
    {
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO `user` ( `user_email`, `password`, `date`) VALUES ( '$email', '$hash', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        
        
        header("Location: /forum\index.php?signup=true");

    }
}
else
{
 
   
    header("Location: /forum\index.php?passMatch=true");
}


}




?>