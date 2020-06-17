<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Car.php';

    $datebase = new Database();
    $db = $datebase->connect();

    $car = new Car($db);

    //Branie id z url

    $car->id = isset($_GET['id']) ? $_GET['id'] : die();

    $car->read_single();

    $car_arr = array();
    $car_arr = array(
        'id' => $car->id,
        'name' => $car->name,
        'description' => $car->description,
        'year' => $car->year,
        'mileage' => $car->mileage,
        'engine' => $car->engine,
        'fuel' => $car->fuel,
        'price' => $car->price,
        'location' => $car->location,
        'link' => $car->link
    );

    print_r(json_encode($car_arr));
?>