<?php
// echo 'var';
// session_start();
if ($_POST['password'] != $_POST['verification'])
{
    session_start();
    $_SESSION['error'] = 'error';
    header('location: signup.php'); //this is like calling the whole php code in the other page normal lol
    exit();
    // var_dump($_SESSION);
}

?>