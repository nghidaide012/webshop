<?php
session_start();
require('./config.php');
if(!isset($_SESSION['LoggedInUser']))
{
    header('location: ./home.php');
}
else
{
    $query = "SELECT * FROM users WHERE id = '".$_SESSION['LoggedInUser']."'";
    $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    if($row = mysqli_fetch_array($result))
    {
        $name = $row['name'];
        $address = $row['address'];
        $phone = $row['phone'];
        $email = $row['email'];
    }
}
function searchEmail($mail)
{
    global $link;
    $query = "SELECT email FROM users WHERE email = '".mysqli_real_escape_string($link, $mail)."'";
    $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    $row = mysqli_num_rows($result);
    if($row)
    {
        return 0;

    }
    else
    {
        return 1;
    }
}
?>
<?php
require_once "./header_footer/header.php";
?>
    <link href="../css/profile.css" rel="stylesheet"/>
<?php
require_once "./header_footer/nav_bar.php";
?>

<main>
<div class="container">
    <div class="left-container">
        <h3><a href="./profile.php"  style="color:red;">Personal Information</a></h3>
        <h3><a href="./changePass.php">Change Password</a></h3>
        <h3><a href="./order_history.php">Order History</a></h3>

    </div>
    <div class="right-container">
        <h3>Personal Information</h3>
        <?php
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if(!isset($_POST['email']))
                {
                    echo '<h3 class="error-message">Email cant be empty</h3>';
            
                }
                elseif(empty($_POST['email']))
                {
                    echo '<h3 class="error-message">Email cant be empty</h3>';
            
                }
                else{
                    $name = htmlspecialchars($_POST['name']);
                    $address = htmlspecialchars($_POST['address']);
                    $phone = htmlspecialchars($_POST['phone']);
                    $emailIn = htmlspecialchars($_POST['email']);
                    if(searchEmail($emailIn) || $emailIn == $email)
                    {
                        $query = "UPDATE users SET name = '".mysqli_real_escape_string($link, $name)."', address = '".mysqli_real_escape_string($link, $address)."', phone = '".mysqli_real_escape_string($link, $phone)."'
                        , email = '".mysqli_real_escape_string($link, $email)."' WHERE id = '".$_SESSION['LoggedInUser']."'";
                        $result = mysqli_query($link, $query);
                        if ($result) {
                            echo '<h3 class="success">Data updated successfully.</h3>';

                        } else {
                            echo "Error updating data: " . mysqli_error($link);
                        }

                    }
                    else
                    {
                    echo '<h3 class="error-message">This email already exist</h3>';
                    }
                }
            }
        ?>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'];?>">
            <div class="form-container">
                <label for="name">Name</label><br>
                <input type="text" name="name" id="name" value="<?= $name;?>"/>
            </div>
            <div class="form-container">
                <label for="address">Address</label><br>
                <input type="text" name="address" id="address" value="<?= $address;?>"/>
            </div>
            <div class="form-container">
                <label for="phone">Phone number</label><br>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" value="<?= $phone;?>">
            </div>
            <div class="form-container">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" value="<?= $email;?>"/>
            </div>
            <input type="submit" value="Save" />
        </form>
    </div>
</div>
</main>
<?php
require_once './header_footer/footer.php';
mysqli_close($link);
?>