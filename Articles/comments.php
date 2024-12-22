<?php
session_start();
include '../queryfast.php';
include '../access.php';
function redirect($path)
{
    header("location: $path");
    exit();
}
// var_dump($_POST);
$commentContent = $_POST['comment'];
var_dump($_SESSION);
$commentOwnerId = $_SESSION['userId'];
$articleId = $_POST['articleid'];
$tagName = $_POST['tagName'];

$stmnt = "INSERT INTO comments (article_id, user_id, content) values ((?), (?), (?))";
$stmnt = $connect->prepare($stmnt);
$stmnt->bind_param("sss", $articleId, $commentOwnerId, $commentContent);
$stmnt->execute();
// echo $tagName;
redirect("http://localhost:8000/Articles/articles.php/?tag=$tagName");
?>