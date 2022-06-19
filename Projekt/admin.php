<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Administration</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@300;400&display=swap" rel="stylesheet">
</head>

<body>

<?php require_once "header.php" ?>
    <section class="bljus">

  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $basename = "projekt";

    $dbc = mysqli_connect($servername, $username, $password, $basename) or
    die('Error connecting to MySQL server.' . mysqli_connect_error());
        $query = "SELECT * FROM articles";
        $result = mysqli_query($dbc, $query);
        echo 
            "<form method='POST' action=''>
            <select id='choose' name='choose'>";
               while(($row = mysqli_fetch_array($result)))
               {
                    echo "<option value='" . $row["title"] . "'>" . $row["title"] . "</option>";
               }
            echo "</select>
            <button type='submit' name='bus' value='bus'>Choose</button>
            </form>
            ";

            
            
          
               if(isset($_POST["bus"]))
               {
                $cring = $_POST["choose"];
                $query = "SELECT * FROM articles WHERE title = '$cring'";
                $result = mysqli_query($dbc, $query);
                $row = mysqli_fetch_array($result);

                echo ' 

                <form enctype="multipart/form-data" method="POST">
            
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" value="'.$row['title'].'">
                <br>
                <label for="description">Description:</label><br>
                <textarea name="description" id="description" cols="30" rows="10">'.$row['description'].'</textarea>
                <br>
                <label for="content">Content:</label><br>
                <textarea name="content" id="content" cols="30" rows="10">'.$row['content'].'</textarea>
                <br>
                <label for="slik">Picture:</label><br>
                <input type="file" accept="image/jpg, image/gif, image/png, images/jpeg" value="'.$row['picture'].'" name="slik" id="slik"/>
                <br>
                <label for="category">Category:</label><br>
                <select id="category" name="category" value="'.$row['category'].'">
                <option value="melee">Melee</option>
                <option value="ranged">Ranged</option>
                </select>
                <br>
                <label>Archive:';
                if($row['archive'] == 0) {
                echo '<input type="checkbox" name="archive" id="archive"/>';
                } else {
                echo '<input type="checkbox" name="archive" id="archive" checked/>';
                }
                echo '
                </label>
                <br>
                <input type="hidden" name="id" value="'.$row['id'].'">
                <button type="reset" value="reset">Reset</button>
                <button type="submit" name="update" value="Accept"> 
                Update</button>
                <button type="submit" name="delete" value="Delete"> 
                Delete</button>
            
                </form>';

               

               }
            
               if(isset($_POST["delete"]))
               {
                   $id= $_POST['id'];
                   $query = "DELETE FROM articles WHERE id=$id";
                   $result = mysqli_query($dbc, $query);

                   header("Refresh:0");
                  
               }
   
               if(isset($_POST["update"]))
               {
   
                   $title = str_replace("'", "''", $_POST["title"]);
                   $desc = str_replace("'", "''", $_POST["description"]);
                   $content = str_replace("'", "''", $_POST["content"]);
                   $category = $_POST['category'];
   
                   if(isset($_POST["archive"]))
                   {
                       $archive = 1;
                   }
                   else
                   {
                       $archive = 0;
                   }
   
                   if(is_uploaded_file($_FILES['slik']['tmp_name']))
                   {
                       
                       $picture = $_FILES['slik']['name'];
                       $dir = 'images/'.$picture;
                       move_uploaded_file($_FILES["slik"]["tmp_name"], $dir);
                       $id = $_POST['id'];
                       $query = "UPDATE articles
                       SET title = ?, description= ?, content = ?, picture = ?, category = ?, archive = ? WHERE id = $id";
                       $stmt = mysqli_stmt_init($dbc);
                       if(mysqli_stmt_prepare($stmt, $query))
                       {
                            mysqli_stmt_bind_param($stmt, "ssssss", $title, $desc, $content, $picture, $category, $archive);
                            mysqli_stmt_execute($stmt);
                       }
                       

                   }
                   else
                   {
                       $id = $_POST['id'];
                       $query = "UPDATE articles
                       SET title = ?, description = ?, content = ?, category = ?, archive = ? WHERE id = $id";
                       $stmt = mysqli_stmt_init($dbc);
                       
                       if(mysqli_stmt_prepare($stmt, $query))
                       {
                        mysqli_stmt_bind_param($stmt, "sssss", $title, $desc, $content, $category, $archive);
                        mysqli_stmt_execute($stmt);
                       }
                       
                   }
                   
   
               }
   
        mysqli_close($dbc);
    ?>

            </section>
    <footer>
        <p>Fran Radan</p>
        <p>fradan@tvz.hr</p>
        <p>2022</p>
    </footer>
</body>

</html>