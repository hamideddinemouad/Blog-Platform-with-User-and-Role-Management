<div id='tagsDash' class='hidden flex flex-col gap-4'>
<h1>Tags</h1>
<?php
include '../../access.php';
    $stmnt = "SELECT * FROM articles";
    $Mysobj = queryFast($connect, $stmnt);
    $result = $Mysobj->get_result();
    $row = $result->fetch_assoc();
    while ($row)
    {
        $title = $row['title'];
        $content = $row['content'];
        $creationDate = $row['createdAt'];
        $articleId = $row['id'];
        $userId = $row['user_id'];
        echo 
        "<div id='showTags'>
        <h1 class='text-3xl font-semibold text-gray-800'>$title</h1>
        <form action='form-handler.php' method='post' class='inline'>
                <input type='hidden' name='formtype' value='deletecomment'>
                <input type='hidden' name='commenttodelete' value='$commentId'>
                <button
                    type='submit'
                    class='bg-red-600 text-white text-sm font-semibold rounded-md px-4 py-2 hover:bg-red-700'>
                    Delete article
                </button>
            </form>
        <p class='text-sm text-gray-500 mt-2'>$creationDate</p>
        </div>
        ";
        $row = $result->fetch_assoc();
    }
    // var_dump($_SESSION);
    ?>
</div>
