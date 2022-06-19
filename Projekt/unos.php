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
    <?php require_once "header.php"?>

    <div class="div2">
    <form class="prva" action="preview.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <br>
        <input type="text" id="title" name="title">
        <span id="titleMess"></span>
        <br>
        <label for="description">Description:</label>
        <br>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
        <span id="descriptionMess"></span>
        <br>
        <label for="content">Content:</label>
        <br>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <span id="contentMess"></span>
        <br>
        <label for="slik">Picture:</label>
        <br>
        <input type="file" accept="image/jpg, image/gif, image/png, images/jpeg" name="slik">
        <br>
        <label for="category">Category:</label>
        <select name="category">
            <option value="melee">Melee</option>
            <option value="ranged">Ranged</option>
        </select>
        <br>
        <label for="archive">Archive:</label>
        
        <input type="checkbox" name="archive">
        <br>
        <button type="reset" name="reset">Reset</button>
       <button type="submit" id="submit" name="submit">Submit</button>
    </form>
    </div>
    <script type="text/javascript">
        document.getElementById("submit").onclick = function (event) {

            var slanje_forme = true

            var cringe = document.getElementById("title")
            var title = document.getElementById("title").value

            if (title.length > 15) {
                slanje_forme = false
                document.getElementById("titleMess").innerHTML = "<br>Character name cannot be longer than 15 characters!"
            }
            else if (title.length == 0)
            {
                slanje_forme = false
                document.getElementById("titleMess").innerHTML = "<br>Character name is required!"
            }

            var cringe2 = document.getElementById("description")
            var description = document.getElementById("description").value

            if (description.length > 30) {
                slanje_forme = false
                document.getElementById("descriptionMess").innerHTML = "<br>Character class cannot be longer than 30 characters!"
            }

            else if (description.length == 0)
            {
                slanje_forme = false
                document.getElementById("descriptionMess").innerHTML = "<br>Character class is required!"
            }

            var cringe3 = document.getElementById("content")
            var content = document.getElementById("content").value

            if (content.length < 30 || content.length > 2000) {
                slanje_forme = false
                document.getElementById("contentMess").innerHTML = "<br>Character description must be between 30 and 2000 characters!"
            }

            if(slanje_forme != true)
            {
                event.preventDefault()
            }

        }

    </script>

    <footer>
        <p>Fran Radan</p>
        <p>fradan@tvz.hr</p>
        <p>2022</p>
    </footer>
</body>

</html>