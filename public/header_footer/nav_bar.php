

</head>
<body>
    <header>
        <div class="logo">
        <a href='./home.php'><img src="../images/icon/sushlogo.png" width="80px" /></a>
        <a href='./home.php'><h2>sushi</h2></a>
        </div>
        <nav>
            <section class="menu section">
                <a href="./home.php">Home</a>
            </section>
            <?php if(!isset($_SESSION['LoggedInUser'])){ ?>
            <section class="login section">
                <a href="./login.php">Login</a>
            </section>
            <?php }
            else{ ?>
            <?php
                if($_SESSION['permission'] == 1){
            ?>
            <section class="admin section">
                <a href="./admin.php">Admin</a>
            </section>
            <?php } ?>
            <section class="profile section">
                <a href="./profile.php">Profile</a>
            </section>
            <section class="logout section">
                <a href="./logout.php">Log out</a>
            </section>
            <?php }
            ?>

        </nav>
    </header>