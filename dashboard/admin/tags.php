<div id='tagsDash' class='hidden flex flex-col gap-4'>
<h1>Tags</h1>


<?php 
// include 'form-handler.php';
include '../../access.php';
$tagstable = $connect->query("select * from tags");
$row = $tagstable->fetch_assoc();
while ($row)
{
    $tagName = $row['name'];
    echo 
    "
    <ul class='flex flex-col  justify-between items-center gap-4 p-4 bg-gray-100 rounded-lg shadow-lg'>
        <li class='text-lg font-semibold text-gray-800'>
            <span class='block md:inline'>Tag:</span>
            <form action='form-handler.php' method='post'>
                <input type='hidden' name='formtype' value='modifytag'>
                <input type='hidden' name='prevtagname' value='$tagName'>
                <label for='tagnamemodify'></label>
                <input type='text' id='tagnamemodify' name='newname' value='$tagName'>
                <button
                    class='bg-yellow-500 text-white text-sm font-semibold rounded-md px-4 py-2 hover:bg-yellow-600'>
                    Modify Tag
                </button>
            </form>
        </li>
        <li class='flex flex-col md:flex-row items-center gap-4'>
            <form action='form-handler.php' method='post' class='inline'>
                <input type='hidden' name='formtype' value='deletetag'>
                <input type='hidden' name='tagtodelete' value='$tagName'>
                <button
                    type='submit'
                    class='bg-red-600 text-white text-sm font-semibold rounded-md px-4 py-2 hover:bg-red-700'>
                    Delete Tag
                </button>
            </form>
        </li>
    </ul>
";
    $row = $tagstable->fetch_assoc();
}
?>
<div>
<form action='form-handler.php' method="post" class="inline">
        <input type='hidden' name='formtype' value='addtag'>
        <label for='tagnameform'></label>
        <input type='text' id='tagnameform' name='newtag'>
        <button type='submit'
            class='bg-green-600 text-white text-sm font-semibold rounded-md px-4 py-2 hover:bg-green-700'>
            Create Tag
        </button>
 
        <p id=tagexist class="text-red-700 hidden">tag name already exists</p>

        <?php if (isset($_SESSION['tagexists']))
        {
            echo "<script>document.querySelector('#tagexist').classList.toggle('hidden')</script>";
            unset($_SESSION['tagexists']);
        }
        ?>
    </form>
    </div>
</div>