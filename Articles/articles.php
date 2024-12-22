<?php 
// var_dump($_GET);
session_start();
include '../queryfast.php';
include '../access.php';
function bringUserName($connection, $userId)
{
    $stmnt = "SELECT name FROM users WHERE id = (?)";
    $response = queryFast($connection, $stmnt, "s", [$userId]);
    $result = $response->get_result();
    $row = $result->fetch_assoc();
    return $row['name'];
}
function renderComments($connection, $articleId)
{
    $stmnt = "SELECT * FROM comments WHERE article_id = (?)";
    $response = queryFast($connection, $stmnt, "s", [$articleId]);
    $result = $response->get_result();
    $row = $result->fetch_assoc();
    $comments = '';
    while ($row)
    {
        $commentOwner = bringUserName($connection, $row['user_id']);
        $content = $row['content'];
        $comments .=         "
        <div class='space-y-6 mt-4'>
        <div class='bg-gray-50 p-4 rounded-lg'>
            <p class='font-semibold text-gray-800'>$commentOwner</p>
            <p class='text-gray-600 mt-2'>$content</p>
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
    <script src="http://localhost:8000/Articles/nav.js" defer></script>
    <title>Document</title>
</head>

<body>
<?php include '../navbar/navbar.php'; ?>
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <?php
    $tagName = $_GET['tag'];
    $stmnt = "SELECT id from tags where name = (?)";
    $Mysobj = queryFast($connect, $stmnt, "s", [$tagName]);
    $result = $Mysobj->get_result();
    $row = $result->fetch_assoc();
    $tagId = $row['id'];
    $stmnt = "SELECT * FROM articles WHERE tag_id = (?)";
    $Mysobj = queryFast($connect, $stmnt, "s", [$tagId]);
    $result = $Mysobj->get_result();
    $row = $result->fetch_assoc();
    while ($row)
    {
        $title = $row['title'];
        $content = $row['content'];
        $creationDate = $row['createdAt'];
        $articleId = $row['id'];
        $userId = $row['user_id'];
        $comments = renderComments($connect, $articleId);
        echo 
        "<header>
        <h1 class='text-3xl font-semibold text-gray-800'>$title</h1>
        <p class='text-sm text-gray-500 mt-2'>$creationDate</p>
        </header>
    
        <section class='mt-6'>
        <p class='text-lg text-gray-700'>$content</p>
        </section>
        $comments
        ";
        if (isset($_SESSION['connected']))
        {
            echo
            "
            <div class='mt-10'>
    <h3 class='text-xl font-semibold text-gray-800'>Leave a Comment</h3>
    <form action='http://localhost:8000/Articles/comments.php' method='POST' class='mt-4'>
        <input type='hidden' name='articleid', value=$articleId>
        <input type='hidden' name='commentowner', value='$userId'>
        <input type='hidden' name='tagName', value='$tagName'>
        <div class='mb-4'>
            <label for='comment' class='block text-gray-700'>Comment:</label>
            <textarea id='comment' name='comment' rows='1' required class='w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent'></textarea>
        </div>
        <button type='submit' class='w-full p-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500'>Submit</button>
    </form>
</div>
";
        }
        else
        {
            echo "<h2 class='text-2xl text-blue-600 font-semibold mb-4'>Login to Comment</h2>";
        }
        $row = $result->fetch_assoc();
    }
    // var_dump($_SESSION);
    ?>
</div>
</body>
</html>
