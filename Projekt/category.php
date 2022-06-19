<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Category</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400&display=swap" rel="stylesheet">
</head>

<body>

<?php require_once "header.php" ?>

    <h2 class="joj">Melee</h2>
    <section class="flek">

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $basename = "projekt";

        $dbc = mysqli_connect($servername, $username, $password, $basename) or
        die('Error connecting to MySQL server.' . mysqli_connect_error());

        $query = "SELECT * FROM articles WHERE archive = 0 AND category = 'melee' ORDER BY id DESC";
        $result = mysqli_query($dbc, $query);

        while($row = mysqli_fetch_array($result))
        {
            echo "<article class='art'>";
            echo "<form action='article.php' method='post'>
            <input type='hidden' name='test'>
            <button type='submit' name='submit' value='" . $row["picture"] . "'>
            <img src='images/" . $row["picture"] . "'></button>
            </form>";
            echo "<h4 class='artTitle'>" . $row["title"] . "</h4>";
            echo "<p class='artDesc'>" . $row["description"] . "</p>";
            echo "</article>";
        }

        mysqli_close($dbc);

    ?>

    </section>

    <h2 class="joj">Ranged</h2>
    <section class="flek">

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $basename = "projekt";

        $dbc = mysqli_connect($servername, $username, $password, $basename) or
        die('Error connecting to MySQL server.' . mysqli_connect_error());

        $query = "SELECT * FROM articles WHERE archive = 0 AND category = 'ranged' ORDER BY id DESC";
        $result = mysqli_query($dbc, $query);

        while($row = mysqli_fetch_array($result))
        {
            echo "<article class='art'>";
            echo "<form action='article.php' method='post'>
            <input type='hidden' name='test'>
            <button type='submit' name='submit' value='" . $row["picture"] . "'>
            <img src='images/" . $row["picture"] . "'></button>
            </form>";
            echo "<h4 class='artTitle'>" . $row["title"] . "</h4>";
            echo "<p class='artDesc'>" . $row["description"] . "</p>";
            echo "</article>";
        }

        mysqli_close($dbc);

    ?>

    </section>


    <hr>

    <footer>
        <p>Fran Radan</p>
        <p>fradan@tvz.hr</p>
        <p>2022</p>
    </footer>
</body>

</html>