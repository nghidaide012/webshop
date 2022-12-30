<?php
    require("./config.php");
    function list_user()
{
    global $link;
    $query = "SELECT * FROM users";
    $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    return $result;
}
    function search_user($user)
{
    $result = list_user();
    while($row = mysqli_fetch_array($result))
    {
        if($row['email'] == $user)
        {
            return 1;
        }
    }
    return 0;
}
?>

<?php
require_once './header_footer/header.php';
?>
<link href="../css/login.css" rel="stylesheet" />
<?php
require_once './header_footer/nav_bar.php';
?>
<main>
<h3>Sign In</h3>
<?php
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['conpassword']))
    {
        echo '<h3 class="error-message">You need to fill all the form</h3>';

    }
    elseif(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['conpassword']))
    {
        echo '<h3 class="error-message">You need to fill all the form</h3>';

    }
    else{
        $user = htmlspecialchars($_POST['username']);
        $pass = htmlspecialchars($_POST['password']);
        $conpass = htmlspecialchars($_POST['conpassword']);
        if(filter_var($user, FILTER_VALIDATE_EMAIL))
        {
            if($pass == $conpass)
            {
                if(!search_user($user))
                {
                    $escaped_user = mysqli_real_escape_string($link, $user);
                    $password_hash = password_hash($pass, PASSWORD_DEFAULT);
                    $escaped_password = mysqli_real_escape_string($link, $password_hash);
                    $query = "INSERT INTO users (email, password) VALUES ('".$escaped_user."', '".$escaped_password."')";
                    if(mysqli_query($link, $query))
                    {
                        echo '<h3 class="success">Create account complete!</h3>';
                        header('location: login.php');
                    }

                }
                else
                {
                  echo '<h3 class="error-message">This email already exists, please try a different one!</h3>';

                }
            }
            else
            {
                echo '<h3 class="error-message">Password and Confirm password have to be the same, please try again</h3>';
            }
        }
        else{
            echo '<h3 class="error-message">This email is not valid, please try again!</h3>';
        }
        
    }
}
?>
<form method="post" id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="username">Email</label><br>
    <input type="username" name="username" id="username" /><br>
    <label for="pass">Password</label><br>
    <input type="password" name="password" id="pass" /><br>
    <label for="conpass">Confirm Password</label><br>
    <input type="password" name="conpassword" id="conpass" /><br>
    <input type="submit" value="Sign In"/>
</form>
<p>Already have an account? <a href="./login.php">Login</a></p>
</main>
<?php
require_once './header_footer/footer.php';
mysqli_close($link);
?>