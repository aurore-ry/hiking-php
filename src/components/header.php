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
                        echo "<li><a href='../newhike.php'>add hike</a></li>";
                        echo "<li class='user'><a href=' ../profile.php'>". $_SESSION["username"] ." connected</a></li>";
                        echo "<li><a class=\"header-login\" href='../includes/logout.inc.php'>Logout</a></li>";
                    } else {
                        echo "<li><a href='../signup.php'>Signup</a></li>";
                        echo "<li><a class=\"header-login\" href='../login.php'>Login</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>