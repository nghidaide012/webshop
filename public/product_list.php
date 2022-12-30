<?php
session_start();
require('./config.php');
if(isset($_SESSION['LoggedInUser']) && $_SESSION['permission'] == 1)
{
    if(isset($_POST['delete_pro']))
    {
        $query = "DELETE FROM products WHERE ID ='". $_POST['delete_pro']."'";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    }
    if(isset($_POST['de-activate']))
    {
        $query = "UPDATE products SET active = 0 WHERE ID ='". $_POST['de-activate']."'";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    }
    if(isset($_POST['activate']))
    {
        $query = "UPDATE products SET active = 1 WHERE ID ='". $_POST['activate']."'";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    }
    $query = "SELECT * FROM products";
    

if(isset($_GET['search']) &&  !empty($_GET['search']))
{
    $search = mysqli_escape_string($link, htmlspecialchars($_GET['search']));
    $query .= " WHERE name LIKE '%".$search."%'";
}
$result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");

while($row =  mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $data_url = '../uploaded_img/' . $row['image'];
    echo '
    <div class="products-list"> 
    <p><img src="'.$data_url.'" width="150px"></p>
    <div class="product-info">
    <p><i style="color:rgb(255, 117, 117);">ID:</i> '.$row['id'].'</p>
    <p><i style="color:rgb(255, 117, 117);">Name:</i> '.$row['name'].'</p>
    <p><i style="color:rgb(255, 117, 117);">Description:</i> ' .$row['description'].'</p>
    <p><i style="color:rgb(255, 117, 117);">Price:</i> '.$row['price'].'$</p>
    <p><i style="color:rgb(255, 117, 117);">Quantity:</i> '.$row['quantity'].'</p>
    <p><i style="color:rgb(255, 117, 117);">Category ID:</i> '.$row['category_id'].'</p>
    </div>
    <div class="modify-product">';
    
    if($row['active'])
    {
       echo '<button class="activate"  data-product-id="'.$row['id'].'" onclick="deactivateProduct('.$row['id'].')">Deactivate</button>';
    }
    else
    {
        echo '<button class="activate"  data-product-id="'.$row['id'].'" onclick="Activate('.$row['id'].')">Activate</button>';
    }
    
    echo '<button id="delete_pro" class="ri-delete-bin-line delete-button" data-product-id="'.$row['id'].'" onclick="deleteProduct('.$row['id'].')"></button>
    </div></div>';
}
}
else
{
    header('location: ./home.php');
}
