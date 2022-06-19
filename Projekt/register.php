<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Naslovnica</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400&display=swap" rel="stylesheet">
</head>

<body>

<?php require_once "header.php" ?>

<div class="div">
    <form class="prva"  method="post">
        <label for="username">Username:</label>
        <br>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Password:</label>
        <br>
        <input type="password" id="password" name="password">
        <br>
       <button type="submit" value="login" name="login">Login</button>
    </form>

    <form class="druga" method="post">
        <label for="username">Username:</label>
        <br>
        <input type="text" id="username" name="username">
        <span id="userMess"></span>
        <br>
        <label for="password">Password:</label>
        <br>
        <input type="password" id="password" name="password">
        <br>
        <label for="password2">Repeat password:</label>
        <br>
        <input type="password" id="password2" name="password2">
        <span id="passwordMess2"></span>
        <br>
        <label for="level">Admin:</label>
        <input type="checkbox" id="level" name="level">
        <br>
        <button type="submit" name="register" id="register">Register</button>
    </form>
</div>
    <?php
    
    
        $servername = "localhost";
        $username = "root";
        $password = "";
        $basename = "projekt";

        $dbc = mysqli_connect($servername, $username, $password, $basename) or
        die('Error connecting to MySQL server.' . mysqli_connect_error());

            
            if(isset($_POST["register"]))
            
            {
                
                $uName = $_POST["username"];
                $pass = $_POST["password"];
                $hashedPassword = password_hash($pass, CRYPT_BLOWFISH);
                $level = isset($_POST["level"]);

                $pass2 = $_POST["password2"];

                $check = mysqli_query($dbc, "SELECT * FROM users where username = '" . $uName . "'");
                if(mysqli_num_rows($check))
                {
                   exit("Username already exists!");
                }

                if(strlen($uName) == 0)
                {
                    echo "Username is required!";
                }
                if(strlen($uName) < 5 || strlen($uName) > 15)
                {
                    echo "Username must be between 5 and 15 characters!";
                }

                if(strlen($pass) == 0 || strlen($pass2) == 0 || $pass != $pass2)
                {
                    echo "Passwords must match!";
                }

                else
                {
                    $query = "INSERT INTO users (username, password, level) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($dbc);
                    if(mysqli_stmt_prepare($stmt, $query))
                    {
                        mysqli_stmt_bind_param($stmt, 'sss', $uName, $hashedPassword, $level);
                        mysqli_stmt_execute($stmt);
                    }
                    echo "Successfully created new user";  
                }

            }
            
            if(isset($_POST["login"]))
            {
                $uName = $_POST["username"];
                $pass = $_POST["password"];

                $query = "SELECT * FROM users";
                $result = mysqli_query($dbc, $query);

                $postoji = false;
                while($row = mysqli_fetch_array($result))
                {
                    if($uName == $row["username"] && password_verify($pass, $row["password"]))
                    {
                        $_SESSION["user"] = $row["username"];
                        $_SESSION["level"] = $row["level"];
                        header("Refresh:0");
                        $postoji = true;
                        break;
                    }
                }  

                if($postoji == false)
                {
                    echo "Wrong username or password!";
                }
               
            }
      
            mysqli_close($dbc);

    ?>

    <footer>
        <p>Fran Radan</p>
        <p>fradan@tvz.hr</p>
        <p>2022</p>
    </footer>
</body>

</html>