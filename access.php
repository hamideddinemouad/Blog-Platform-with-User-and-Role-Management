<?php
$connect = new mysqli("localhost", "root", "123456", "blog");
if ($connect->connect_errno)
{
    die("connect ERROR" . $connect->connect_errno);
}

?>