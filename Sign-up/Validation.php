<?php
// echo 'var';
// session_start();
function redirect($path)
{
    header("location: $path");
    exit();
}

if ($_POST['password'] != $_POST['verification'])
{
    session_start();
    $_SESSION['error'] = 'error';
    redirect('signup.php'); //this is like calling the whole php code in the other page normal lol
    // var_dump($_SESSION);
}
include '../access.php';

$hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
$name = $_POST['name'];
$email = $_POST['email'];
$user_input = [$name, $email, $hashed, 4];
if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    session_start();
    $_SESSION['invalidmail'] = 1;
    redirect('signup.php');
}
$stmnt = $connect->prepare('INSERT INTO users (name, mail, password, role_id) VALUES ((?), (?), (?), (?))');
try
{
    $result = $stmnt->execute($user_input);
}
catch (Exception $e)
{
    session_start();
    // echo $e->getMessage();
    $_SESSION['sqlerror'] = $e->getMessage();
    redirect('signup.php');
}
finally
{
    redirect('../Sign-in/login.php');
}
// if (!$result)
// {
//     error();
// }
// echo $hashed;
// $stmnt = $connect->prepare("INSERT INTO users");
?>