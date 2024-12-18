<?php
function login_errors()
{
    session_start();

    if(isset($_SESSION['mailnot']))
    {
        echo '<script>document.querySelector("#emailnot").classList.toggle("hidden");</script>';
        session_unset();
    }
}
?>
