<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Car.php';

    $datebase = new Database();
    $db = $datebase->connect();

    $car = new Car($db);

    $result = $car->read();

    $num = $result->rowCount();

    if ($num > 0)
    {
        $cars_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            $car_item = array(
                'id' => $id,
                'name' => $name,
                'year' => $year,
                'mileage' => $mileage,
                'fuel' => $fuel,
                'price' => $price,
                'location' => $location,
                'link' => $link
            );

            array_push($cars_arr, $car_item);
        }
        echo json_encode($cars_arr);
    }
    else
    {
        echo json_encode(array('message' => 'No Car Found'));
    }
?>