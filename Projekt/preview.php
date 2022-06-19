<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $basename = "projekt";

    $dbc = mysqli_connect($servername, $username, $password, $basename) or
    die('Error connecting to MySQL server.' . mysqli_connect_error());

    $title = str_replace("'", "''", $_POST["title"]);
    $desc = str_replace("'", "''", $_POST["description"]);
    $content = str_replace("'", "''", $_POST["content"]);

    $category = $_POST["category"];
    
    if(isset($_POST["archive"]))
    {
        $archive = 1;
    }
    else
    {
        $archive = 0;
    }
    
    $picture = $_FILES['slik']['name'];
    $dir = 'images/' . $picture;
    move_uploaded_file($_FILES['slik']['tmp_name'], $dir);

    $query = "INSERT INTO articles (title, description, category, picture, content, archive)
    VALUES ('$title', '$desc', '$category', '$picture', '$content', '$archive')";

    $result = mysqli_query($dbc, $query) or die("Error querying database.");
    mysqli_close($dbc);

?> 

<!DOCTYPE html>
<html>

<head>
    
    <meta charset="UTF-8">
    <title>Unos</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400&display=swap" rel="stylesheet">
</head>

<body>


<?php require_once "header.php" ?>

<section class="flek">
<article class="art2">


        <?php 

            echo "<p>" . $category . "</p>";
            echo "<h4 class='artTitle'>" . $title . "</h4>";
            echo "<p class='artDesc'>" . $desc . "</p>";
            echo "<img src='images/$picture'>";
            echo "<p class='artCont'>" . $content . "</p>";

        ?>
   
    
</article>
</section>
    <footer>
        <p>Fran Radan</p>
        <p>fradan@tvz.hr</p>
        <p>2022</p>
    </footer>
</body>

</html>

