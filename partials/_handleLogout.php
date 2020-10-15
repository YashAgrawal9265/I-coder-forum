<?php
session_start();
echo"<p class='font-weight-bold'>Login out. Please wait for sometime.</p>";
session_destroy();
session_unset();
header("location:/forum/index.php");

?>