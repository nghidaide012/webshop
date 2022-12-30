<?php
require('./config.php');
session_start();

?>
<?php
require_once "./header_footer/header.php";
?>
    <link href="../css/menu.css" rel="stylesheet"/>
    <script src="../js/menu.js" async></script>
<?php
require_once "./header_footer/nav_bar.php";
?>
<script>
    let lastBtnclicked = 0;
    
    
    function order() {
  var url = "order_items.php";
  var xhr = new XMLHttpRequest();
  if (xhr != null) {
    xhr.open("GET", url, true);
    xhr.send(null);
    xhr.onreadystatechange = function() { show_cart(xhr); };
  }
}

function show_cart(xhr) {
  var output = document.getElementById("item-container");
  if (xhr.readyState == 4 && xhr.status == 200) {
    if (xhr.responseText) {
      output.innerHTML = xhr.responseText;
    } else {
      output.innerHTML = "No result";
    }
  } else {
    output.innerHTML = "No result";
  }
  return output.innerHTML;
}

function start(searchID, searchString) {
  var url = "product_list_customer.php";
  var xhr = new XMLHttpRequest();
  if (xhr != null) {
    if (searchString.trim() === "") {
      url += "?searchID=" + searchID;
      xhr.open("GET", url, true);
      xhr.send(null);
    } else {
      url += "?searchID=" + searchID + "&search=" + searchString;
      console.log(url);
      xhr.open("GET", url, true);
      xhr.send(null);
    }
    xhr.onreadystatechange = function() { showResult(xhr); };
  }
}

function showResult(xhr) {
  var output = document.getElementById("product-wrap");
  if (xhr.readyState == 4 && xhr.status == 200) {
    if (xhr.responseText) {
      output.innerHTML = xhr.responseText;
    } else {
      output.innerHTML = "No result";
    }
  } else {
    output.innerHTML = "No result";
  }
}
    
    document.addEventListener('DOMContentLoaded', function() 
    {
        start(lastBtnclicked, "");
        order();
    });

</script>   
<main>
    
    <h1>Menu</h1>
<div class="container">
    <div class="category">
        <ul>
        <li><a href="#" onclick="lastBtnclicked = 0; start(lastBtnclicked, ''); ">All</a></li>
    <?php
        $query = "SELECT id, name FROM categories";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
        while($row = mysqli_fetch_array($result))
        {
            echo '<li><a href="#" onclick="lastBtnclicked = '.$row['id'].'; start(lastBtnclicked,'."''".');">'.$row['name'].'</a></li>';
        }
        
    ?>
        </ul>
    </div>
    <div class="product-list">
        <form action="#">
        <input type="text" id="input" onkeyup="start(lastBtnclicked, this.value);" placeholder="Search" />
        </form>
        <div id="product-wrap">
        </div>
    </div>
    <div class="cart">
        <?php
        if(isset($_SESSION['LoggedInUser']))
        {
        ?>
        <h1>My basket</h1>
        <div id="item-container">
        </div>
        <?php } ?>
    </div>
</div>
</main>
<?php
require_once './header_footer/footer.php';
?>