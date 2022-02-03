<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include_once('mysqli_def.php');
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
        $cities = $_SESSION['connect']->query("SELECT * FROM `cities`");
        echo "<nav>";
            if ($cities) {
                while ($row = mysqli_fetch_assoc($cities)) {
                    echo "<a href=/".$row['city_name']."><div>";
                        echo "<p>".$row['city_name']."</p>";
                    echo "</div></a>";
                }
            }
            else echo "No data in Database!";
        echo "</nav>";

        if (isset($_GET['params'])) {
            $params = explode( "/", $_GET['params']);
            count($params) >= 1 ? $city_name = $params[0] : $city_name = false;
            count($params) >= 2 ? $donut_name = $params[1] : $donut_name = false;

            function city_print($str) {
                echo "<div class='city'><p>Your city is ". $str."</p>";
                echo "<img src=/img/".strtolower($str).".jpg></div>";
            }

            function donut_link_print($city) {
                $donuts = $_SESSION['connect']->query("SELECT * FROM `donut_types`");
                echo "<div class='donuts'>";
                    while ($row = mysqli_fetch_assoc($donuts)) {
                        echo "<a href=/".$city.'/'.$row['type'].">";
                            echo "<img src=/img/".$row['id'].".webp>";
                        echo "</a>";
                    }
                echo "</div>";
            }

            function donut_print($str) {
                $result = $_SESSION['connect']->query("SELECT * FROM `donut_types` WHERE `type` LIKE '%{$str}%' ");
                $donut = $result->fetch_assoc();
                echo "<div class='donut'><p>Your donut is ". $donut['type']."</p>";
                echo "<img src=/img/".$donut['id'].".webp></div>";
            }
    
            $city_name ? city_print($city_name) : false;
            $city_name ? donut_link_print($city_name) : false;
            $donut_name ? donut_print($donut_name) : false;
        }
    ?>
</body>
</html>