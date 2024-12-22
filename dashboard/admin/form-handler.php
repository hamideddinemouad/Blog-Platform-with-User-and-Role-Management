<?php
session_start();
include '../../access.php';
// var_dump($_POST);
function redirect($path)
{
    header("location: $path");
    exit();
}

$formType = $_POST['formtype'];




function changeRole($connection)
{
    $userID = $_POST['user'];
    $newRole =  $_POST['role'];
    $stmnt = "UPDATE users SET role_id=(?) where id=(?);";
    $stmnt = $connection->prepare($stmnt);
    echo $newRole;
    echo $userID;
    $stmnt->bind_param("ss", $newRole, $userID);
    $stmnt->execute();
    echo $stmnt->get_result();
    redirect('admindash.php');
}

function editTag($connection)
{
    // var_dump($_POST);
    $prevName = $_POST['prevtagname'];
    $newName = $_POST['newname'];
    $connection->query("UPDATE TAGS SET name='$newName' WHERE name='$prevName'");
    redirect('admindash.php');
}

function getTagId ($connection, $tagName)
{
    // echo $stmnt;
    $tagTable = $connection->query("SELECT id FROM tags where name='$tagName'");
    // $tagTable = $connection->query('SELECT * FROM tags');
    // echo "stopped?";
    // var_dump($tagTable);
    $row = $tagTable->fetch_assoc();
    // var_dump($row);
    // var_dump($tagTable);
    $tagId = $row['id'];
    return $tagId;
}

function deleteTag($connection)
{
    $tag = $_POST['tagtodelete'];
    $tagId = getTagId($connection, $tag);
    $stmnt = "delete from articles where tag_id=(?)";
    $stmnt = $connection->prepare($stmnt);
    $stmnt->bind_param("s", $tagId);
    $stmnt->execute();
    $stmnt = "delete from tags where name=(?)";
    $stmnt = $connection->prepare($stmnt);
    $stmnt->bind_param("s", $tag);
    $stmnt->execute();

    redirect('admindash.php');
}
function createTag($connection)
{
    $newTag = $_POST['newtag'];
    $stmnt = "select * from tags where name=(?)";
    $stmnt = $connection->prepare($stmnt);
    $stmnt->bind_param("s", $newTag);
    $stmnt->execute();
    $result = $stmnt->get_result();
    $rows = $result->num_rows;
    if ($rows > 0)
    {
        var_dump($_SESSION);
        $_SESSION['tagexists'] = 1;
        redirect('admindash.php');
    }
    $stmnt = "INSERT INTO tags (name) values ((?));";
    $stmnt = $connection->prepare($stmnt);
    $stmnt->bind_param("s", $newTag);
    $stmnt->execute();
    redirect('admindash.php');
    // echo($stmnt->affected_rows);
}
switch ($formType)
{
    case 'changeRole':
        changeRole($connect);
    case 'modifytag':
        editTag($connect);
    case 'deletetag' :
        deleteTag($connect);
    case 'addtag' :
        createTag($connect);
}
?>