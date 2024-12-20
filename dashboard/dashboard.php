<?php
session_start();
function redirect($path)
{
    header("location: $path");
    exit();
}
switch ($_SESSION['role'])
{
  case '1':
    redirect('http://localhost:8000/dashboard/admin/admindash.php');
}
?>
