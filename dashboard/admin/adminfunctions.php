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
    $options = '';
    while ($row)
    {

        $option = $row['rolename'];
        $roleId = $row['id'];
        $options .= "<option value='$roleId'  class='text-sm'>$option</option>";
        $row = $rolesTable->fetch_assoc();
    }
    return $options;
}
function get_role_name ($connection, $roleId)
{
    $rolesTable = $connection->query("select * from roles where id= $roleId");
    $row = $rolesTable->fetch_assoc();
    return $row['rolename'];
}
function show_users($connection)
{
    $usersTable = $connection->query("select * from users where name != 'admin'");
    $row = $usersTable->fetch_assoc();

    
    while ($row)
    {
        $userId = $row['id'];
        $roleId = $row['role_id'];
        $roleName = get_role_name($connection, $roleId);
        $userName = $row['name'];
        $options = drop_down_roles($connection, $roleId);
        echo
        "
<ul class='flex flex-col md:flex-row justify-between items-center gap-4 p-4 bg-gray-100 rounded-lg shadow-lg'>
    <li class='text-lg font-semibold text-gray-800'>
        <span class='block md:inline'>User: </span> 
        <span class='text-blue-600'>$userName</span>
    </li>
    <li class='text-lg font-semibold text-gray-800'>
        <span class='block md:inline'>Role: </span>
        <span class='text-green-600'>$roleName</span>
    </li>
    <li class='flex flex-col md:flex-row items-center gap-4'>
        <div class='flex items-center'>
            <p class='text-gray-700 font-medium'>Change Role:</p>
        </div>
        <form action='form-handler.php' method='post' class='flex items-center gap-3'>
            <input type='hidden' name='formtype' value='changeRole'>
            <input type='hidden' name='user' value='$userId'>
            <input type='hidden' name='oldrole' value='$roleName'>
            <select 
                name='role' 
                id='roleSelect' 
                class='text-sm rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500'
            >
                $options
            </select>
            <button 
                type='submit' 
                class='bg-blue-600 text-white text-sm font-semibold rounded-md px-4 py-2 hover:bg-blue-700'
            >
                Submit
            </button>
        </form>
    </li>
</ul>
        ";
        $row = $usersTable->fetch_assoc();
    }
}

?>