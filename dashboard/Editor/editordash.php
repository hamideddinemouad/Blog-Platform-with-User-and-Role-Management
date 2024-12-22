<?php

session_start(); 
function queryFast($connection, $stmnt, $binding = NULL, $param=[])
{
    if (empty($param) || !$binding)
    {
        $stmnt = $connection->prepare($stmnt);
        $stmnt->execute();
        return $stmnt;
    }
    $stmnt = $connection->prepare($stmnt);
    $values = implode(",", $param);
    $stmnt->bind_param($binding, $values);
    $stmnt->execute();
    return $stmnt;
}
function bringUserName($connection, $userId)
{
    $stmnt = "SELECT name FROM users WHERE id = (?)";
    $response = queryFast($connection, $stmnt, "s", [$userId]);
    $result = $response->get_result();
    $row = $result->fetch_assoc();
    return $row['name'];
}
function renderComments($connection)
{
    $stmnt = "SELECT * FROM comments";
    $response = queryFast($connection, $stmnt);
    $result = $response->get_result();
    $row = $result->fetch_assoc();
    $comments = '';
    while ($row)
    {
        $commentOwner = bringUserName($connection, $row['user_id']);
        $content = $row['content'];
        $commentId = $row['id'];
        $comments .=         "
        <div class='space-y-6 mt-4'>
        <div class='bg-gray-50 p-4 rounded-lg'>
            <p class='font-semibold text-gray-800'>$commentOwner</p>
            <p class='text-gray-600 mt-2'>$content</p>
                        <form action='form-handler.php' method='post' class='inline'>
                <input type='hidden' name='formtype' value='deletecomment'>
                <input type='hidden' name='commenttodelete' value='$commentId'>
                <button
                    type='submit'
                    class='bg-red-600 text-white text-sm font-semibold rounded-md px-4 py-2 hover:bg-red-700'>
                    Delete comment
                </button>
            </form>
        </div>    
        </div>
        ";
        $row = $result->fetch_assoc();
    }
    return $comments;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
  <script src="script.js" defer></script>
  <title>Dashboard editor</title>
</head>

<body>
  <header>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
          <img src="images/logo.svg" class="h-8" alt="Flowbite Logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">The blog</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="true">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
          </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
          <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

            <li>
              <a href="http://localhost:8000/index.php" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
            </li>
            <?php
            include '../../navbuttons.php';
            navbuttons();
            ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main class="text-center w-screen  h-screen flex ">
    <div id="options" class="text-center w-1/4 bg-amber-200">
      <ul class="flex flex-col justify-around h-3/4 py-10">
        <?php
        $name = $_SESSION['username'];
        echo "<li class='cursor-pointer hover:text-white text-2xl'>Hello $name </li>";
        ?>
        <li id="showUsers" class="cursor-pointer hover:text-white">comments</li>
      </ul>
    </div>
    <div class="overflow-y-scroll w-3/4 h-auto bg-gradient-to-br from-gray-50 via-gray-100 to-gray-200 p-6 rounded-xl shadow-xl flex flex-col gap-16">

      <div id="details" class="hidden flex flex-col md:gap-2">
        <h1 class="text-xl">Users and roles</h1>
        <?php 
        include '../../access.php';
        $comments = renderComments($connect);
        echo $comments;
        ?>

    </div>
  </main>
</body>

</html>