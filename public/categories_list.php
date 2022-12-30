<?php
session_start();
require('./config.php');
if(isset($_SESSION['LoggedInUser']) && $_SESSION['permission'] == 1)
{
    if(isset($_POST['delete_ca']))
    {
        $query = "DELETE FROM categories WHERE ID ='". $_POST['delete_ca']."'";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
        $query = "DELETE FROM products WHERE category_id ='". $_POST['delete_ca']."'";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    }
    $query = "SELECT id,name FROM categories";

if(isset($_GET['search']) &&  !empty($_GET['search']))
{
    $search = mysqli_escape_string($link, htmlspecialchars($_GET['search']));
    $query .= " WHERE name LIKE '%".$search."%'";
}
$result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
echo '
<div class="categories-list"> 
<p>ID</p>
<p>Name</p>
<p></p>
</div>';
while($row = mysqli_fetch_array($result))
{

    echo '
    <div class="categories-list"> 
    <p>'.$row['id'].'</p>
    <p>'.$row['name'].'</p>
    <button id="delete_ca" class="ri-delete-bin-line delete-button" data-category-id="'.$row['id'].'" onclick="deleteCategory('.$row['id'].')"></button>
</div>';
}
}
else
{
    header('location: ./home.php');
}
