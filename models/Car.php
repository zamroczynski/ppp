<?php
    class Car
    {
        private $conn;
        private $table = 'cars';

        public $id;
        public $name;
        public $description;
        public $year;
        public $mileage;
        public $engine;
        public $fuel;
        public $price;
        public $location;
        public $link;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function read()
        {
            $query = 'SELECT * FROM cars';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

    }
?>