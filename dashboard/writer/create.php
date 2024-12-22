<?php
include '../../access.php';
function redirect($path)
{
    header("location: $path");
    exit();
}
session_start();
var_dump($_SESSION);
var_dump($_POST);
$userId = $_SESSION['userId'];
$tag= $_POST['tag'];
$articletitle = $_POST['articletitle'];
$content = $_POST['contentarticle'];
// INSERT INTO tags (name) values ((?));
$stmt = $connect->prepare("INSERT INTO articles (user_id, tag_id, title, content, createdAt) VALUES (?, ?, ?, ?, CURDATE())");
$stmt->bind_param("iiss", $userId, $tag, $articletitle, $content);
$stmt->execute();
redirect("http://localhost:8000/dashboard/Writer/writerdash.php");
?>