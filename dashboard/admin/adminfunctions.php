<?php
// var_dump($connect);

function show_articles($connection)
{
    $articlesTable = $connection->query('select * from users');
}
function drop_down_roles($connection, $roleId)
{
    $rolesTable = $connection->query("select * from roles where id != $roleId");
    $row = $rolesTable->fetch_assoc();
    while ($row)
    {
        $option = $row['name'];
        echo "<option value='' class='text-sm'>$option</option>";
    }
}
function get_role_name ($connection, $roleId)
{
    $rolesTable = $connection->query("select * from roles where id= $roleId");
    $row = $rolesTable->fetch_assoc();
    return $row['rolename'];
}
function show_users($connection)
{
    $usersTable = $connection->query('select * from users');
    $row = $usersTable->fetch_assoc();

    
    while ($row)
    {
        $roleId = $row['role_id'];
        $connection->query("select * from roles where id= $roleid");
        $userName = $row['name'];
        echo
        "
<ul class='flex justify-center gap-3 items-center flex-col md:flex-row h-auto '>
    <li>$userName</li>
    <li>role</li>
    <li class='flex flex-col md:flex-row gap-3'>
      <div class='flex  justify-center items-center'><p class=''>change role :</p></div>
      <form action='' method='post'>
      <input type='hidden', name='changeRole', value=''hange'>
      <input type='hidden' name='user' value='useridentification'>
      <select name='' id='' value='' class='text-sm rounded-md'>
      <option value='' class='text-sm '>admin</option>
      </select>
      <button class='bg-black text-white rounded-md p-1' type='submit'>submit</button>
      </form>
    </li>
</ul>
        ";
        $row = $usersTable->fetch_assoc();
    }
}
?>