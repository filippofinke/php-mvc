<!-- template pagina home -->
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/assets/style.css">
    </head>
    <body>
        <p>Sei loggato :D</p>
        <a href="<?php echo URL.'home/logout'; ?>">Esegui il logout!</a>
        <hr>
        <?php
        foreach ($books as $book) {
            echo '<p>'.$book["name"]." ".$book["description"]."</p>";
        }
        ?>
        <hr>
        <?php
        foreach ($users as $user) {
            echo '<p>'.$user["id"]." ".$user["email"]."</p>";
        }
        ?>
    </body>
</html>