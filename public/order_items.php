<?php
session_start();
require('./config.php');
if (isset($_SESSION['LoggedInUser'])) {
    if(isset($_POST['delProductId']) && isset($_POST['delOrderID']))
    {
        $query = "DELETE FROM order_details WHERE order_id = ".$_POST['delOrderID']." AND product_id = ".$_POST['delProductId']."";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");

    }
    if(isset($_POST['enProductId']) && isset($_POST['enOrderID']))
    {
        $query = "UPDATE order_details SET quantity = quantity + 1 WHERE order_id = ".$_POST['enOrderID']." AND product_id = ".$_POST['enProductId']."";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");

    }
    if(isset($_POST['deProductId']) && isset($_POST['deOrderID']))
    {
        $query = "UPDATE order_details SET quantity = quantity - 1 WHERE order_id = ".$_POST['deOrderID']." AND product_id = ".$_POST['deProductId']."";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
        $query = "SELECT quantity FROM order_details WHERE order_id = ".$_POST['deOrderID']." AND product_id = ".$_POST['deProductId']."";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
        $row = mysqli_fetch_array($result);
        if ($row['quantity'] == 0) {
            $query = "DELETE FROM order_details WHERE order_id = ".$_POST['deOrderID']." AND product_id = ".$_POST['deProductId']."";
            $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
        }

    }
    if(isset($_POST['comOrder']) && isset($_POST['total']))
    {
        $query = "UPDATE orders SET order_date = CURDATE(), is_cart = 1, total = ".$_POST['total']." WHERE id = ".$_POST['comOrder']."";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");

    }
    if(isset($_POST['addPro']))
    {
        $query = "SELECT * FROM orders WHERE customer_id = ".$_SESSION['LoggedInUser']." AND is_cart = 0";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
        if (mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $order_items = "SELECT * FROM order_details WHERE order_id = ".$row['id']."";
                $order_items_result = mysqli_query($link, $order_items) or die("Error: an error has occurred while executing the query");
                if(mysqli_num_rows($order_items_result) > 0)
                {
                    $order_items = "SELECT * FROM order_details WHERE order_id = ".$row['id']." AND product_id = ".$_POST['addPro']."";
                    $order_items_result = mysqli_query($link, $order_items) or die("Error: an error has occurred while executing the query");
                    if(mysqli_num_rows($order_items_result) > 0)
                    {
                        $order_items = "UPDATE order_details SET quantity = quantity + 1 WHERE order_id = ".$row['id']." AND product_id = ".$_POST['addPro']."";
                        $order_items_result = mysqli_query($link, $order_items) or die("Error: an error has occurred while executing the query");
                    }
                    else
                    {
                        $order_items = "INSERT INTO order_details (order_id, product_id, quantity) VALUES (".$row['id'].", ".$_POST['addPro'].", 1)";
                        $order_items_result = mysqli_query($link, $order_items) or die("Error: an error has occurred while executing the query");
                    }
                }
                else
                {
                    $order_items = "INSERT INTO order_details (order_id, product_id, quantity) VALUES (".$row['id'].", ".$_POST['addPro'].", 1)";
                    $order_items_result = mysqli_query($link, $order_items) or die("Error: an error has occurred while executing the query");
                }
            }
        }
        else
        {
            $query = "INSERT INTO orders (customer_id) VALUES (".$_SESSION['LoggedInUser'].")";
            $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
            $query = "SELECT * FROM orders WHERE customer_id = ".$_SESSION['LoggedInUser']." AND is_cart = 0";
            $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
            while($row = mysqli_fetch_array($result))
            {
                $order_items = "INSERT INTO order_details (order_id, product_id, quantity) VALUES (".$row['id'].", ".$_POST['addPro'].", 1)";
                $order_items_result = mysqli_query($link, $order_items) or die("Error: an error has occurred while executing the query");
            }
        }
            
    }

    $query = "SELECT * FROM orders WHERE customer_id = ".$_SESSION['LoggedInUser']." AND is_cart = 0";
    $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    $total = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row4 = mysqli_fetch_array($result)) {
            $order_items = "SELECT * FROM order_details WHERE order_id = ".$row4['id']."";
            $order_items_result = mysqli_query($link, $order_items) or die("Error: an error has occurred while executing the query");
            while ($row2 = mysqli_fetch_array($order_items_result)) {

                $product = "SELECT * FROM products WHERE id = ".$row2['product_id']."";
                $product_result = mysqli_query($link, $product) or die("Error: an error has occurred while executing the query");
                $row3 = mysqli_fetch_array($product_result);

                echo '<div class="item">
                  <div class="item-info">
                    <button class="ri-arrow-up-s-line increase-button amount-button" onclick="IncreaseItemCart('.$row2['product_id'].','.$row2['order_id'].')"></button>
                    <button class="ri-arrow-down-s-line decrease-button amount-button" onclick="DecreaseItemCart('.$row2['product_id'].','.$row2['order_id'].')"></button>
                    <p class="amount">'.$row2['quantity'].'x</p>
                    <p class="name">'.$row3['name'].'</p> 
                  </div>
                  <h3 class="price-cart">$ '.$row3['price'] * $row2['quantity'].'</h3>
                  <button class="delete-button"><i class="ri-close-line" onclick="DeleteItemCart('.$row2['product_id'].','.$row2['order_id'].')"></i></button>
                </div>';
                $total += $row3['price'] * $row2['quantity'];
            }
            echo '<button  class="place-order-button" onclick="completeOrder('.$row4['id'].', '.$total.')"><h2>Place Order</h2><h2>$'.$total.'</h2></button>';
        }
    } else {

        echo '<p>No orders found for the logged-in user.</p>';
    }
}