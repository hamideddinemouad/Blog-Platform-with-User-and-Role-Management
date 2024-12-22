<?php
include '../access.php';
// var_dump($_POST);
function redirect($path)
{
    header("location: $path");
    exit();
}
// var_dump($_POST);
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
    session_start();
    $_SESSION['connected'] = 1;
    $stmnt = "SELECT role_id, name, id from users WHERE mail= (?);";
    $stmnt = $connect->prepare($stmnt);
    $stmnt->bind_param("s", $email);
    $stmnt->execute();
    $result = $stmnt->get_result();
    $row = $result->fetch_assoc();
    $_SESSION['role'] = $row['role_id'];
    $_SESSION['username'] = $row['name'];
    $_SESSION['userId'] = $row['id'];
    // $_SESSION['userDbId'] = $row['id'];
    redirect('../dashboard/dashboard.php');
}
else
{
    session_start();
    $_SESSION['incorrectpassword'] = 1;
    redirect('login.php');
}
?>