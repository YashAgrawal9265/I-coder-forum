<?php
// Connecting to the dabase----
$server = "localhost";
$user = "root";
$password = "";
$database = "forem";

$conn = mysqli_connect($server, $user, $password, $database);
if(!$conn)
{
    die("Sorry unabe to connect to the database".mysqli_connect_error());
}

 

?>


