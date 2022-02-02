<?php
    include_once('mysqli_def.php');

    if (isset($_GET['params'])) {
        $params = explode( "/", $_GET['params']);
        $city = $params[0];
        $donut = $params[1];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing htaccess</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <?php
        $cities = $mysqli->query("SELECT * FROM cities");
        echo "<nav>";
        while ($row = mysqli_fetch_assoc($cities)) {
            echo "<a href=/".$row['city_name']."><div>";
                echo "<p>".$row['city_name']."</p>";
            echo "</div></a>";
        }
        echo "</nav>";

        function city_print($str) {
            echo "<div><p>Your city is ". $str."</p>";
        }

        function donut_print($str) {
            echo "<div><p>Your donut is ". $str."</p>";
            echo "<img src=".strtolower($str).">";
        }

        $city ? city_print($city) : false;
        $donut ? donut_print($donut) : false;
    ?>
</body>
</html>