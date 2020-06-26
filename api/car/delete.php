<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Car.php';

    $datebase = new Database();
    $db = $datebase->connect();

    $car = new Car($db);

    if($car->delete())
    {
        echo json_encode(array('message' => 'Baza wyczyszczona'));
    }
    else
    {
        echo json_encode(array('message' => 'Błąd czyszczenia'));
    }
?>