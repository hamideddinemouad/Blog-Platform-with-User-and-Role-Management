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
  case '2':
    redirect('http://localhost:8000/dashboard/Editor/editordash.php');
  case '3':
    redirect('http://localhost:8000/dashboard/Writer/writerdash.php');
  default :
    redirect('http://localhost:8000/index.php');
}
?>
