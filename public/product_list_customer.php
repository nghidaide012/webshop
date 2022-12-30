<?php
session_start();
require('./config.php');


$query = "SELECT * FROM products WHERE active = 1";
if(isset($_GET['searchID']) && !empty($_GET['searchID']))
{
    $search_id = intval($_GET['searchID']);
    if($search_id > 0)
    {
        $query .= " AND category_id = '".$search_id."'";
    }
}

if(isset($_GET['search']) &&  !empty($_GET['search']))
{
    $search = mysqli_escape_string($link, htmlspecialchars($_GET['search']));

        $query .= " AND name LIKE '%".$search."%'";
    
}

$result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
while($row =  mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    $data_url = '../uploaded_img/' . $row['image'];
    echo '
    <div class="product">
        <img src="'.$data_url.'" width="120px">
        <p class="title">'.$row['name'].'</p>
        <p class="price">$ '.$row['price'].'</p>';
        if(isset($_SESSION['LoggedInUser']))
        {
        echo '<button  class="ri-add-line add-button" onclick="addToCart('.$row['id'].')"></button>';
        }
        echo '</div>';
}



