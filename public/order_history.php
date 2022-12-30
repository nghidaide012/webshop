<?php
session_start();
require('./config.php');
if(!isset($_SESSION['LoggedInUser']))
{
    header('location: ./home.php');
}
else
{
    
}
?>
<?php
require_once "./header_footer/header.php";
?>
    <link href="../css/profile.css" rel="stylesheet"/>
<?php
require_once "./header_footer/nav_bar.php";
?>
<script>
function deleteOrder(orderID) {

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'order_customer.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
    if (xhr.status === 200) {
        // handle the response from the server
        start("");
    }
    };
    xhr.send('delete_order=' + encodeURIComponent(orderID));

}
function start(searchString)
    {
        xhr = new XMLHttpRequest();
        url = "order_customer.php";
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
    start("");
    }
</script>

<main>
<div class="container">
    <div class="left-container">
        <h3><a href="./profile.php">Personal Information</a></h3>
        <h3><a href="./changePass.php">Change Password</a></h3>
        <h3><a href="./order_history.php">Order History</a></h3>
    </div>
    <div class="right-container">
    <form action="#">
    <input type="text" id="input" onkeyup="start(this.value);" placeholder="Search" />
    </form>
        <div id="output"></div>
    </div>
</div>
</main>
<?php
require_once './header_footer/footer.php';
mysqli_close($link);
?>