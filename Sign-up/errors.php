<?php

function signupErrors()
{
  // session_start();
  // session_unset();
  // var_dump($_SESSION);
  if (isset($_SESSION['error']))
  {
    session_unset();
    echo '
          <script defer>
          document.querySelector("#unmatch").classList.toggle("hidden");
          </script>';
  }
  if ((isset($_SESSION['invalidmail'])))
  {
    session_unset();
    echo
    '
    <script defer>document.querySelector("#errormail").classList.toggle("hidden");</script>
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
    <script defer>
      let errorno = document.querySelector('#errorno');
      errorno.classList.toggle('hidden');
    </script>
    ";
  }
}
?>