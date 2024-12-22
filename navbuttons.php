<?php
function logOutButton($logOutPage)
{
    if (isset($_SESSION['connected']))
{
    echo "
        <li>
        <a href='$logOutPage' class='block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500' aria-current='page'>Log Out</a>
        </li>
        ";
}
}
function navbuttons()
{
    $loginpage = 'http://localhost:8000/Sign-in/login.php';
    $signuppage = 'http://localhost:8000/Sign-up/signup.php';
    $dashboard = 'http://localhost:8000/dashboard/dashboard.php';
    // $_SERVER['DOCUMENT_ROOT'] . '/Sign-in/login.php';
    if (!isset($_SESSION['connected']))
    {
        echo
        "
        <li>
        <a href='$loginpage' class='block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500' aria-current='page'>Sign In</a>
        </li>
        <li>
        <a href='$signuppage' class='block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500' aria-current='page'>Sign Up</a>
        </li>
        ";
    }
    else
    {
        if ($_SESSION['role'] != 4)
        {
        echo
        "
        <li>
        <a href='$dashboard' class='block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent'>Dashboard</a>
        </li>
        ";
        }
        logOutButton("http://localhost:8000/logout/logout.php");
    }
}
?>
