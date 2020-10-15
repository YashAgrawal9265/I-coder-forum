<?php
include "_dbconnect.php";

if($_SERVER['REQUEST_METHOD']=="POST")
{
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];
    $sql="SELECT * FROM `user` WHERE user_email='$email'";
    $result=mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $row=mysqli_fetch_assoc($result);
    
    
    if($num==1)
    {
        $verify=password_verify($password, $row['password']);
        if($verify)
        {
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['email']=$email;
            $_SESSION['user_id']=$row['Sr No'];
            
            // echo $_SESSION['email'];
            header("location: /forum/index.php");
        }
        
        else
        {
            header("location: /forum/index.php?loginError=true");
            
            
        }
        
        
    }
    else
    {
        header("location: /forum/index.php?loginUser=true");

    }
    
    

}

?>