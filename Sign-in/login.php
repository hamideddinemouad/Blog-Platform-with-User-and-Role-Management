<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
  <title>Login</title>
</head>

<body class="h-screen w-screen">
  <div class="flex justify-center h-[100%] w-[100%] items-center">
    <form action="logincheck.php" class="max-w-sm mx-auto" method="post" >
      <div class="mb-5">
        <label for="email" class="block mb-2 text-sm font-medium text-black dark:text-black">Your email</label>
        <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
      </div>
      <div class="mb-5">
        <label for="password" class="block mb-2 text-sm font-medium text-black dark:text-black">Yor passwrd</label>
        <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-blacl text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
      </div>
      <div class="flex items-start mb-5">
        <div class="flex items-center h-5">
          <button type="submit" class="text-black bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
          <div id="emailnot" class="text-red-700 hidden">Email isn't registred</div>
    </form>
  </div>
  <?php
    include 'errors.php';
    login_errors();
    ?>
</body>
</html>