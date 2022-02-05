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
        function printAll($variables) {
            $cities = $_SESSION['connect']->query("SELECT * FROM `cities`");
            if ($cities) {
                echo "<nav>";
                while ($row = mysqli_fetch_assoc($cities)) {
                    if (!is_null($variables[1])) {
                        echo "<a href=/".$row['city_name'].'/'.$variables[1]."><div>"; 
                    }
                    else {
                        echo "<a href=/".$row['city_name']."><div>";
                    }
                    echo "<p>".$row['city_name']."</p>";
                    echo "</div></a>";
                }
                echo "</nav>";
            }
            else echo "No data in Database!";

            $donuts = $_SESSION['connect']->query("SELECT * FROM `donut_types`");

            if (!is_null($variables[0])) {
                // Проверка или есть такой город, если нет - редирект на индекс
                echo "<div class='city'><p>Your city is ". $variables[0]."</p>";
                echo "<img src=/img/".strtolower($variables[0]).".jpg></div>";

                echo "<div class='donuts'>";
                while ($row = mysqli_fetch_assoc($donuts)) {
                    echo "<a href=/".$variables[0].'/'.$row['type'].">";
                    echo "<img src=/img/".$row['id'].".webp>";
                    echo "</a>";
                }
                echo "</div>";
            }

            if (is_null($variables[0])) {
                echo "<div class='donuts'>";
                while ($row = mysqli_fetch_assoc($donuts)) {
                    echo "<a href=/".$row['type'].">";
                    echo "<img src=/img/".$row['id'].".webp>";
                    echo "</a>";
                }
                echo "</div>";
            }

            if (!is_null($variables[1])) {
                $result = $_SESSION['connect']->query("SELECT * FROM `donut_types` WHERE `type` LIKE '%{$variables[1]}%' ");
                $donut = $result->fetch_assoc();
                echo "<div class='donut'><p>Your donut is ". $donut['type']."</p>";
                echo "<img src=/img/".$donut['id'].".webp></div>";
            }   
        }

        if (isset($_GET['params'])) {
            $params = explode( "/", $_GET['params']);
            $result = $_SESSION['connect']->query("SELECT * FROM `cities` WHERE `city_name` LIKE '%{$params[0]}%' ")->fetch_assoc();
            if (!is_null($result)) {
                count($params) >= 1 ? $city_name = $params[0] : $city_name = NULL;
                count($params) >= 2 ? $donut_name = $params[1] : $donut_name = NULL;
                $params = [$city_name, $donut_name];
            }
            else {
                $donut_name = $params[0];
                $params = [NULL, $donut_name];
            }
        }
        else $params = [NULL, NULL];

        printAll($params);
    ?>
</body>
</html>