<?php
session_start();
if(isset($_SESSION['LoggedInUser']))
{
    header('location: ./home.php');
}
require('./config.php');
function search_user($user, $pass)
{
    $result = list_user();
    $found = 0;
    while($row = mysqli_fetch_array($result))
    {
        if($row['email'] == $user)
        {
            if(password_verify($pass,$row['password']))
            {
                $found = 1;
                break;
            }
        }
    }
    if($found)
    {
        $_SESSION['LoggedInUser'] = $row['id'];
        $_SESSION['permission'] = $row['permission'];
        header('location: ./home.php');
    }
    else{
        echo '<h3 class="error-message">Incorrect username or password.</h3>';

    }
    
}
function list_user()
{
    global $link;
    $query = "SELECT * FROM users";
    $result = mysqli_query($link, $query) or die("Error: an error has occurred while executing the query");
    return $result;
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
<h3>Login</h3>
<?php
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(!isset($_POST['username']) || !isset($_POST['password']))
    {
        echo '<h3 class="error-message">username and password cant be empty</h3>';

    }
    elseif(empty($_POST['username']) || empty($_POST['password']))
    {
        echo '<h3 class="error-message">username and password cant be empty</h3>';

    }
    else{
        $user = htmlspecialchars($_POST['username']);
        $pass = htmlspecialchars($_POST['password']);
        search_user($user, $pass);
    }
}
?>
<form method="post" id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="username">Username </label><br>
    <input type="username" name="username" id="username" /><br>
    <label for="pass">Password</label><br>
    <input type="password" name="password" id="pass" /><br>
    <input type="submit" value="Login"/>
</form>
<p>Don't have an account? <a href="./register.php">Register</a><p>
</main>
<?php
require_once './header_footer/footer.php';
mysqli_close($link);
?>