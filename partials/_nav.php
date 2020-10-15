<?php
session_start();


echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="/forum/index.php">I-Discuss</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="/forum/index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/forum/about.php">About</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Top Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
            
            $sql = "SELECT * FROM `categories` LIMIT 3";
            $result = mysqli_query($conn, $sql);
            
            while($row = mysqli_fetch_assoc($result))
            {
                $id=$row['category_id'];
                $name=$row['category_name'];
             $desc = $row['category_desc'];
                echo ' <a class="dropdown-item" href="\forum\threadlist.php?id='.$id.'">'. $name .'</a>';
            }
            
            
            
            
                
                
        echo '</div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/forum/contact.php">Contact us</a>
        </li>

    </ul>
    
    <form class="form-inline my-2 my-lg-0" action="/forum/search.php" method="get">
        <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>';
        if(isset($_SESSION['loggedin'])&&($_SESSION['loggedin']))
        {
            echo'<p class="text-light my-0 mx-2">'.$_SESSION['email'].'</p>
            <a href="partials/_handleLogout.php" class="btn btn-outline-success ml-2">Logout</a>';
        }
        else
        {
        echo'<button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
        <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#signupModal">Sign up</button>';
        }
    echo'</form>

    </div>
    </nav>';


        





include 'signup.php';
include 'login.php';


if(isset($_GET['signup'])&& ($_GET['signup']))
{
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You are Sign up successfully. Now you can login.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
}
if(isset($_GET['userExist'])&& ($_GET['userExist']))
{
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> Email is already in use.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
}
if(isset($_GET['passMatch'])&& ($_GET['passMatch']))
{
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> Password do not match.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
}
if(isset($_GET['loginError'])&& ($_GET['loginError']))
{
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> Enter password is incorrect.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
}
if(isset($_GET['loginUser'])&& ($_GET['loginUser']))
{
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> User do not exist. Please sign up first.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
}
 


?>