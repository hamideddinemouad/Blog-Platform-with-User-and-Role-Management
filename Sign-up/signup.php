<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <?php include '../access.php'?>
    <title>Sign up</title>
</head>
<body>
<form action="Validation.php" class="max-w-sm mx-auto" method="post">
  <div class="mb-5">
    <label for="email" class="block mb-2 text-sm font-medium text-black dark:text-black">Your email</label>
    <input type="email" id="email"  name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
  </div>
  <div class="mb-5">
    <label for="password" class="block mb-2 text-sm font-medium text-black dark:text-black">Your password</label>
    <input type="password" id="password" name="password" class="shadow-sm bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required minlength="4" />
  </div>
  <div class="mb-5">
    <label for="repeat-password" class="block mb-2 text-sm font-medium text-black dark:text-black">Repeat password</label>
    <input type="password" id="repeat-password" name="verification" class="shadow-sm bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required minlength="4" />
  </div>
  <div class="flex items-start mb-5">
  <button type="submit" class="text-white  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register new account</button>

<div id="error" class="text-red-700 hidden">Passwords don't match</div>

<?php 
  session_start();
  // session_unset();
  if (isset($_SESSION['error']))
  {
    session_unset();
    echo '
          <script>
          document.querySelector("#error").classList.toggle("hidden");
          document.querySelector
          </script>';
  }
  // var_dump($_SESSION);
   ?>
</form>

</body>
</html>