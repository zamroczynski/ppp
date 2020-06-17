<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
            Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Car.php';

    $datebase = new Database();
    $db = $datebase->connect();

    $car = new Car($db);

    $data = json_decode(file_get_contents("php://input"));

    $car->id = $data->id;
    $car->name = $data->name;
    $car->description = $data->description;
    $car->year = $data->year;
    $car->mileage = $data->mileage;
    $car->engine = $data->engine;
    $car->fuel = $data->fuel;
    $car->price = $data->price;
    $car->location = $data->location;
    $car->link = $data->link;

    if($car->create())
    {
        echo json_encode(array('message' => 'Dodano'));
    }
    else
    {
        echo json_encode(array('message' => 'NIE Dodano'));
    }
?>