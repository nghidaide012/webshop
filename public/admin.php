
<?php
require('./config.php');
session_start();
if(isset($_SESSION['LoggedInUser']) && $_SESSION['permission'] == 1)
{
    
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
<script src="../js/ajax_post.js" defer></script>
<script src="../js/manage_order.js" defer></script>

<?php
require_once "./header_footer/nav_bar.php";
?>
<script>
    let lastBtnclicked = 'customer_list.php';
    function start(url, searchString)
    {
        xhr = new XMLHttpRequest();
        if(xhr != null)
        {
            if(searchString.trim() === "")
            {
                xhr.open("GET", url, true);
                xhr.send(null);
            }
            else
            {
                url += "?search=" + searchString;
                xhr.open("GET", url, true);
                xhr.send(null);
            }
            xhr.onreadystatechange = showResult;
        }
    }
    function showResult() {
        var output = document.getElementById("output");
        if (xhr.readyState == 4 && xhr.status == 200) {
            if(xhr.responseText) {
            output.innerHTML = xhr.responseText;
            } else {
            output.innerHTML = "No result";
            }
        } else {
            output.innerHTML = "No result";
        }
    }
    window.onload = function() {
    start(lastBtnclicked, "");
    }
</script>   
<main>
<div class="container">
    <div class="left-container">
        <h3><a href="#" onclick="lastBtnclicked = 'customer_list.php'; start(lastBtnclicked, '');">Customers</a></h3>
        <h3><a href="#" onclick="lastBtnclicked = 'product_list.php'; start(lastBtnclicked, '');">Products</a></h3>
        <h3><a href="#" onclick="lastBtnclicked = 'categories_list.php'; start(lastBtnclicked, '');">Category</a></h3>
        <h3><a href="#" onclick="lastBtnclicked = 'order_manager.php'; start(lastBtnclicked, '');">Orders</a></h3>
        <h3><a href="./add_product.php">Add product</a></h3>
        <h3><a href="./add_Category.php">Add category</a></h3>

    </div>
    <div class="right-container">
    <form action="#">
    <input type="text" id="input" onkeyup="start(lastBtnclicked, this.value);" placeholder="Search" />
    </form>
    
<div id="output"></div>
</div>
</div>
</main>
<?php
require_once './header_footer/footer.php';
?>