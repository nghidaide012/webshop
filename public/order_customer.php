<?php
session_start();
require('./config.php');
if(isset($_SESSION['LoggedInUser']))
{
    if(isset($_POST['delete_order']))
    {
        $query = "DELETE FROM orders WHERE id = ".$_POST['delete_order']."";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");

    }

    $query = "SELECT * FROM orders WHERE is_cart = 1 AND customer_id = ".$_SESSION['LoggedInUser']."";
    if(isset($_GET['search']) &&  !empty($_GET['search']))
    {
        $search = mysqli_escape_string($link, htmlspecialchars($_GET['search']));
        $query .= " AND id = ".$search."";
    }
    $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    while($row = mysqli_fetch_array($result))
    {
        $customer = "SELECT * FROM users WHERE id = ".$_SESSION['LoggedInUser']."";
        $user_result = mysqli_query($link, $customer) or die("Error: an error has occurred while executing the query");
        $row2 = mysqli_fetch_array($user_result);
        echo '
        <div class="order-container">
            <div class="order-info">
                <h4><i style="color:rgb(255, 117, 117);">Customer:</i> '.$row2['email'].'</h4>
                <h4><i style="color:rgb(255, 117, 117);">Order ID:</i> '.$row['id'].'</h4>
                <h4><i style="color:rgb(255, 117, 117);">Total price:</i> $'.$row['total'].'</h4>
                <div class="order-detail">';
        $detail = "SELECT * FROM order_details WHERE order_id = ".$row['id']."";
        $detail_result = mysqli_query($link, $detail) or die("Error: an error has occurred while executing the query");
        while($row3 = mysqli_fetch_array($detail_result))
        {
            $product = "SELECT * FROM products WHERE id = ".$row3['product_id']."";
            $product_result = mysqli_query($link, $product) or die("Error: an error has occurred while executing the query");
            $row4 = mysqli_fetch_array($product_result);
            echo '
            <h4><i style="color:#aa9981;">Product name:</i> '.$row4['name'].'</h4>
            <h4><i style="color:#aa9981;">Quantity:</i> '.$row3['quantity'].'</h4>
            <h4><i style="color:#aa9981;">Price:</i> '.$row3['quantity'] * $row4['price'].'</h4>
            ';
        }

        echo'</div>
            </div>
            <div class="status">
            <button id="delete_order" class="ri-delete-bin-line delete-button" onclick="deleteOrder('.$row['id'].');"></button>';
            if($row['order_status'] == 0)
            {
                echo'
                <h4 class="pending">Pending!</h4>';
            }
            if($row['order_status'] == 1)
            {
                echo '<h4 class="completed">Completed!</h4>';
            }
            echo'
            </div>
            </div>
        ';
    }

}