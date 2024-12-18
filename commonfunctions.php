<?php
function error()
{
    echo "<script>
            alert('error');
          </script>";
}
function signupErrors()
{
  session_start();
  // session_unset();
  if (isset($_SESSION['error']))
  {
    session_unset();
    echo '
          <script>
          document.querySelector("#error").classList.toggle("hidden");
          </script>';
  }
  if ((isset($_SESSION['invalidmail'])))
  {
    session_unset();
    echo
    '
    <script>document.querySelector("#errormail").classList.toggle("hidden");</script>
    ';
  }
  if ((isset($_SESSION['sqlerror'])))
  {
    echo $_SESSION['sqlerror'];
    session_unset();
    // header('login.php');
    // exit();
    echo
    "
    <script>
      let errorno = document.querySelector('#errorno');
      errorno.classList.toggle('hidden');
    </script>
    ";
  }
}
?>
