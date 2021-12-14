    <header>
        <img src="logo.png" alt="logo">
        <nav>
            <ul>
                <li>
                    <a href="../index.php">Home</a>
                </li>
                <li>
                    <a href="../myhikings.php">My hikings</a>
                </li>
                <?php
                    if (isset($_SESSION["username"])) {
                        echo "<li><a href=' ../profile.php'>". $_SESSION["username"] ." connected</a></li>";
                        echo "<li><a href='../includes/logout.inc.php'>Logout</a></li>";
                    } else {
                        echo "<li><a href='../signup.php'>Signup</a></li>";
                        echo "<li class=\"header-login\"><a href='../login.php'>Login</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>