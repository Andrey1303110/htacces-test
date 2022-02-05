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
        function city_print($str) {
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
            if (isset($str)) {
                echo "<div class='city'><p>Your city is ". $str."</p>";
                echo "<img src=/img/".strtolower($str).".jpg></div>";
            }
        }
        
        function donut_link_print_without_city($str) {
            $donuts = $_SESSION['connect']->query("SELECT * FROM `donut_types`");
            echo "<div class='donuts'>";
                while ($row = mysqli_fetch_assoc($donuts)) {
                    echo "<a href=/".$row['type'].">";
                    echo "<img src=/img/".$row['id'].".webp>";
                    echo "</a>";
                }
            echo "</div>";
            if (isset($str)) {
                $result = $_SESSION['connect']->query("SELECT * FROM `donut_types` WHERE `type` LIKE '%{$str}%' ");
                $donut = $result->fetch_assoc();
                echo "<div class='donut'><p>Your donut is ". $donut['type']."</p>";
                echo "<img src=/img/".$donut['id'].".webp></div>";
            }
        }

        if (isset($_GET['params'])) {
            $params = explode( "/", $_GET['params']);
            
            $result = $_SESSION['connect']->query("SELECT * FROM `cities` WHERE `city_name` LIKE '%{$params[0]}%' ")->fetch_assoc();
            if (!is_null($result)) {
                count($params) >= 1 ? $city_name = $params[0] : $city_name = false;
                count($params) >= 2 ? $donut_name = $params[1] : $donut_name = false;
            }
            if (is_null($result)) {
                $donut_name = $params[0];
                donut_link_print_without_city($donut_name);
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
    
            isset($city_name) ? city_print($city_name) : false;
            isset($city_name) ? donut_link_print($city_name) : false;
            isset($donut_name) ? donut_print($donut_name) : false;
        }

        else {
            city_print(NULL);
            donut_link_print_without_city(NULL);
        }
    ?>
</body>
</html>