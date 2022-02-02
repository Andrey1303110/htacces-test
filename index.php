<?php
    include_once('mysqli_def.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing htaccess</title>

</head>
<body>
    <nav>
        <?php
            $cities = $mysqli->query("SELECT * FROM cities");
            while ($row = mysqli_fetch_assoc($cities)) {
                echo "<div>";
                echo "<a href=/".$row['city_name'].">".$row['city_name']."</a>";
                echo "</div>";
            }
        ?>
    </nav>
</body>
</html>