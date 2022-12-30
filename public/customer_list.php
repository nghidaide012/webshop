<?php
session_start();
require('./config.php');
if(isset($_SESSION['LoggedInUser']) && $_SESSION['permission'] == 1)
{
    if(isset($_POST['delete_cus']))
    {
        $query = "DELETE FROM users WHERE ID ='". $_POST['delete_cus']."'";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    }
    $query = "SELECT id,name, address,phone, email FROM users";

if(isset($_GET['search']) &&  !empty($_GET['search']))
{
    $search = mysqli_escape_string($link, htmlspecialchars($_GET['search']));
    $query .= " WHERE name LIKE '%".$search."%'";
}
$result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
echo '
<div class="customer-list"> 
<p>Name</p>
<p>Address</p>
<p>Email</p>
<p>Phone Number</p>
<p></p>
</div>';
while($row = mysqli_fetch_array($result))
{

    echo '
    <div class="customer-list"> 
    <p>'.$row['name'].'</p>
    <p>'.$row['address'].'</p>
    <p>'.$row['email'].'</p>
    <p>'.$row['phone'].'</p>
    <button id="delete_cus" class="ri-delete-bin-line delete-button" data-customer-id="'.$row['id'].'" onclick="deleteCustomer('.$row['id'].')"></button>
</div>';
}
}
else
{
    header('location: ./home.php');
}
