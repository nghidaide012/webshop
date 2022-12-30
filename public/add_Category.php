
<?php
require('./config.php');
session_start();
if(isset($_SESSION['LoggedInUser']) && $_SESSION['permission'] == 1)
{
    function searchCat($name)
    {
        global $link;
        $query = "SELECT name FROM categories";
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
        <h3>Add Category</h3>
        <?php
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if(!isset($_POST['name']))
                {
                    echo '<h3 class="error-message">Name cant be empty.</h3>';
            
                }
                elseif(empty($_POST['name']))
                {
                    echo '<h3 class="error-message">Name cant be empty.</h3>';
            
                }
                else
                {
                    $name = htmlspecialchars($_POST['name']);
                    if(searchCat($name))
                    {
                        $escape_name = mysqli_escape_string($link, $name);
                        $query = "INSERT INTO categories (name) VALUES ('".$escape_name."')";
                        $result = mysqli_query($link, $query);
                        if ($result) {
                            echo '<h3 class="success">Data updated successfully.</h3>';

                        } else {
                            echo "Error updating data: " . mysqli_error($link);
                        }
                    }
                    else
                    {
                        echo '<h3 class="error-message">This category name already exists.</h3>';

                    }
                    
                }
            }
        ?>
        <form enctype="multipart/form-data" method="POST" action="<?= $_SERVER['PHP_SELF'];?>">
        <div class="form-container">
                <label for="name">Name</label><br>
                <input type="text" name="name" id="name" />
            </div>
            <input type="submit" value="Add">
    </form>
    </div>
</div>
</main>
<?php
require_once './header_footer/footer.php';
?>