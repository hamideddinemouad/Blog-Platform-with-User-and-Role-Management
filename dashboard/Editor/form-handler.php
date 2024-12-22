<?php
include '../../access.php';
$formType = $_POST['formtype'];
function redirect($path)
{
    header("location: $path");
    exit();
}
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
function deleteComment($connection)
{
    queryFast($connection, "delete from comments where id = (?)", "s", [$_POST['commenttodelete']]);
}

switch ($formType)
{
    case 'deletecomment':
        deleteComment($connect);
        redirect('http://localhost:8000/dashboard/Editor/editordash.php');
    case 'deletearticle':
        // editTag($connect);
    case 'deletetag' :
        // deleteTag($connect);
    case 'addtag' :
        // createTag($connect);
}
?>