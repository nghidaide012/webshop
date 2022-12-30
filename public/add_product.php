
<?php
require('./config.php');
session_start();
if(isset($_SESSION['LoggedInUser']) && $_SESSION['permission'] == 1)
{
    function searchPro($name)
    {
        global $link;
        $query = "SELECT name FROM products";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
        while($row = mysqli_fetch_array($result))
        {
            if(strtolower($row['name']) == strtolower($name))
            {
                return 0;
            }
        }
        return 1;
    }
}
else
{

    header('location: ./home.php');
    
}
?>
<?php
require_once "./header_footer/header.php";
?>
<link href="../css/admin.css" rel="stylesheet" />
<?php
require_once "./header_footer/nav_bar.php";
?>

<main>
<div class="container">
    <div class="left-container">
        <h3><a href="./admin.php">Customers</a></h3>
        <h3><a href="./admin.php">Products</a></h3>
        <h3><a href="./admin.php">Category</a></h3>
        <h3><a href="./admin.php">Orders</a></h3>
        <h3><a href="./add_product.php">Add product</a></h3>
        <h3><a href="./add_Category.php">Add category</a></h3>
    </div>
    <div class="right-container">
        <h3>Add Product</h3>
        <?php
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if(!isset($_POST['name']) || !isset($_POST['price']) || !isset($_POST['quantity']) || !isset($_POST['category']) || !isset($_FILES['image']['tmp_name']))
                {
                    echo '<h3 class="error-message">All the fields except description have to be fill.</h3>';
            
                }
                elseif(empty($_POST['name']) || empty($_POST['price']) || empty($_POST['quantity']) || empty($_POST['category']) || empty($_FILES['image']['tmp_name']))
                {
                    echo '<h3 class="error-message">All the fields except description have to be fill.</h3>';
            
                }
                else
                {

                    $name = mysqli_real_escape_string($link, htmlspecialchars($_POST['name']));
                    $description = mysqli_real_escape_string($link, htmlspecialchars($_POST['description']));
                    $price = mysqli_real_escape_string($link, htmlspecialchars($_POST['price']));
                    $quantity = mysqli_real_escape_string($link, htmlspecialchars($_POST['quantity']));
                    $category = mysqli_real_escape_string($link, htmlspecialchars($_POST['category']));
                    $image = $_FILES['image']['name'];
                    chmod('../uploaded_img', 777);
                    if(searchPro($name))
                    {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], "../uploaded_img/".$image))
                    {
                        $query = "INSERT INTO products (name, description, price, quantity, category_id, image) VALUES ('".$name."', '".$description."', '".$price."', '".$quantity."', '".$category."', '".$image."')";
                        $result = mysqli_query($link, $query);
                        if ($result) {
                            echo '<h3 class="success">Data updated successfully.</h3>';

                        } else {
                            echo "Error updating data: " . mysqli_error($link);
                        }
                    }
                    else
                    {
                        echo '<h3 class="error-message">'.$_FILES['image']['error'].'</h3>';

                    }
                    }
                    else
                    {
                    echo '<h3 class="error-message">The product name already exists</h3>';

                    }
                    
                }
            }
        ?>
        <form enctype="multipart/form-data" method="POST" action="<?= $_SERVER['PHP_SELF'];?>">
        <div class="form-container">
                <label for="name">Name</label><br>
                <input type="text" name="name" id="name" />
            </div>
            <div class="form-container">
                <label for="description">Description</label><br>
                <input type="text" name="description" id="description" />
            </div>
            <div class="form-container">
                <label for="price">Price</label><br>
                <input type="number" id="price" name="price"  >
            </div>
            <div class="form-container">
                <label for="quantity">quantity</label><br>
                <input type="number" name="quantity" id="quantity" />
            </div>
            <div class="form-container">
            <select name="category">
            <option value="">Select Category:</option>
            <?php
                $query = "SELECT id, name FROM categories";
                $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
                while($row = mysqli_fetch_array($result))
                {
                    echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
                
            ?>

            </select>
            </div>
        <div class="form-container">
            <label for="image">Choose an image to upload:</label>
            <input type="file" name="image" id="image" accept="image/jpeg,image/png">
        </div>
            <input type="submit" value="Add">
    </form>
    </div>
</div>
</main>
<?php
require_once './header_footer/footer.php';
?>