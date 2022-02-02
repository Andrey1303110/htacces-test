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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        echo "<nav>";
        $cities = $mysqli->query("SELECT * FROM cities");
        while ($row = mysqli_fetch_assoc($cities)) {
            echo "<a href=/".$row['city_name']."><div>";
                echo "<p>".$row['city_name']."</p>";
            echo "</div></a>";
        }
        echo "</nav>";
        var_dump($_GET);
    ?>
</body>
</html>