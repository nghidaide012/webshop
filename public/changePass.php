<?php
session_start();
require('./config.php');
if(!isset($_SESSION['LoggedInUser']))
{
    header('location: ./home.php');
}
else
{
    function checkPass($pass)
    {
        global $link;
        $query = "SELECT password FROM users WHERE id = '".$_SESSION['LoggedInUser']."'";
        $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
        while($row = mysqli_fetch_array($result))
        {
            if(password_verify($pass,$row[0]))
            {
                return 1;
            }
        }
        return 0;
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
        <h3><a href="./profile.php">Personal Information</a></h3>
        <h3><a href="./changePass.php"  style="color:red;">Change Password</a></h3>
        <h3><a href="./order_history.php">Order History</a></h3>

    </div>
    <div class="right-container">
        <h3>Change Password</h3>
        <?php
            if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if(!isset($_POST['password']) || !isset($_POST['newpassword']) || !isset($_POST['conpassword']))
                {
                    echo '<h3 class="error-message">All the field can\'t be empty</h3>';
            
                }
                elseif(empty($_POST['password']) || empty($_POST['newpassword']) || empty($_POST['conpassword']))
                {
                    echo '<h3 class="error-message">All the field can\'t be empty</h3>';
            
                }
                else
                {
                    $oldPass = htmlspecialchars($_POST['password']);
                    $newPass = htmlspecialchars($_POST['newpassword']);
                    $conPass = htmlspecialchars($_POST['conpassword']);
                    if(checkPass($oldPass))
                    {
                        if($newPass == $conPass)
                        {
                            $query = "UPDATE users SET password = '".mysqli_real_escape_string($link, password_hash($newPass, PASSWORD_DEFAULT))."' WHERE id = '".$_SESSION['LoggedInUser']."'";
                        $result = mysqli_query($link, $query);
                        if ($result) {
                            echo '<h3 class="success">Data updated successfully.</h3>';

                        } else {
                            echo "Error updating data: " . mysqli_error($link);
                        }
                        }
                        else
                        {
                            echo '<h3 class="error-message">New password and confirm have to be the same.</h3>';

                        }
                    }
                    else
                    {
                        echo '<h3 class="error-message">Password not correct!!</h3>';
                    }


                }
            }
        ?>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'];?>">
            <div class="form-container">
            <label for="pass">Old Password</label><br>
            <input type="password" name="password" id="pass" /><br>
            </div>
            <div class="form-container">
            <label for="newpass">New Password</label><br>
            <input type="password" name="newpassword" id="newpass" /><br>
            </div>
            <div class="form-container">
            <label for="conpass">Confirm Password</label><br>
            <input type="password" name="conpassword" id="conpass" /><br>
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