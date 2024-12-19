<?php
session_start();
function redirect($path)
{
    header("location: $path");
    exit();
}
if ($_SESSION['role'] === 4)
{
  redirect('../index.php');
};
?>
