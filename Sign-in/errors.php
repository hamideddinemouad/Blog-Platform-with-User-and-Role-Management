<?php
function redirect($path)
{
    header("location: $path");
    exit();
}
function isconnected()
{
    if (isset($_SESSION['connected']))
    {
        redirect("../dashboard/dashboard.php");
    }
}
function login_errors()
{
    // session_start();

    if(isset($_SESSION['mailnot']))
    {
        echo '<script>document.querySelector("#emailnot").classList.toggle("hidden");</script>';
        session_unset();
    }
    if(isset($_SESSION['incorrectpassword']))
    {
        echo '<script>document.querySelector("#passnot").classList.toggle("hidden");</script>';
        session_unset();
    }
}
?>
