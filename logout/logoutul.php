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
?>