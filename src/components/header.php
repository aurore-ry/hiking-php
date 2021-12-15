    <header>
        <img src="logo.png" alt="logo">
        <nav>
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/myhikings">My hikings</a>
                </li>
                <?php
                    if (isset($_SESSION["username"])) {
                        echo "<li><a href='/newhike'>add hike</a></li>";
                        echo "<li class='user'><a href='/profile'>". $_SESSION["username"] ." connected</a></li>";
                        echo "<li><a class=\"header-login\" href='../includes/logout.inc.php'>Logout</a></li>";
                    } else {
                        echo "<li><a href='/signup'>Signup</a></li>";
                        echo "<li><a class=\"header-login\" href='/login'>Login</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </header>