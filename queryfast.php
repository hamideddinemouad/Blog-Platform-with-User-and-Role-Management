<?php
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
?>
