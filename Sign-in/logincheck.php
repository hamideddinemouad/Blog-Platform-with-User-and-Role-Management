<?php
include '../access.php';
// var_dump($_POST);
function redirect($path)
{
    header("location: $path");
    exit();
}
$email = $_POST['email'];

$stmnt = $connect->prepare("SELECT password FROM users WHERE mail = (?)");
$stmnt->bind_param('s', $email);
$stmnt->execute();
$result = $stmnt->get_result();
$row = $result->fetch_assoc();
if (!$row)
{
    session_start();
    $_SESSION['mailnot'] = 1;
    redirect('login.php');
}
if (password_verify($_POST['password'], $row['password']))
{
    echo "connected";
}
else
{
    echo "incorrect pass";
}
?>