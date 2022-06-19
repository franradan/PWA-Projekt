<header class="container">
        <?php session_start();?>
        <h1><img class="logo" src="ris.svg">Arknights character info</h1>
     
        <nav>
            <ul class="flek">
                <li><a href="index.php">Home</a></li>
                <li><a href="category.php">Category</a></li>
                <li><a href="register.php">Register</a></li>
                <?php
                $_SESSION["logged"] = false;
                if(isset($_SESSION["user"]) && $_SESSION["level"] == 1)
                {
                    $_SESSION["logged"] = true;
                    echo '<li><a href="unos.php">Create new</a></li>';
                    echo '<li><a href="admin.php">Administration</a></li>';
                  
                }

                if(isset($_SESSION["user"]) && $_SESSION["level"] == 0)
                {
                    $_SESSION["logged"] = true;
                 
                }
              
                if(isset($_POST["logout"]))
                    {
                        
                        session_unset();
                        session_destroy();
                        header("Refresh:0");
                    }

            ?>
   
            </ul>
        </nav>


        <?php
            if($_SESSION["logged"] == true)
            {
                echo '
                <form class="gore" method="post" action="index.php">
                <button type="submit" name="logout" id="logout">Logout</button>
                </form>';
            }


        ?>
</header>

