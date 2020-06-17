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

        //odczyt wszystkie auta z db
        public function read()
        {
            $query = 'SELECT * FROM cars';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        //odczyt pojedynczy auto z db
        public function read_single()
        {
            $query = 'SELECT * FROM cars WHERE id = ? LIMIT 0,1';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->year = $row['year'];
            $this->mileage = $row['mileage'];
            $this->engine = $row['engine'];
            $this->fuel = $row['fuel'];
            $this->price = $row['price'];
            $this->location = $row['location'];
            $this->link = $row['link'];
        }
        //wysylanie auta do db
        public function create() 
        {
            $query = 'INSERT INTO cars 
            SET
                id = :id,
                name = :name,
                description = :description,
                year = :year,
                mileage = :mileage,
                engine = :engine,
                fuel = :fuel,
                price = :price,
                location = :location,
                link = :link';
            $stmt = $this->conn->prepare($query);
            //czyszczenie
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->year = htmlspecialchars(strip_tags($this->year));
            $this->mileage = htmlspecialchars(strip_tags($this->mileage));
            $this->engine = htmlspecialchars(strip_tags($this->engine));
            $this->fuel = htmlspecialchars(strip_tags($this->fuel));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->location = htmlspecialchars(strip_tags($this->location));
            $this->link = htmlspecialchars(strip_tags($this->link));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':year', $this->year);
            $stmt->bindParam(':mileage', $this->mileage);
            $stmt->bindParam(':engine', $this->engine);
            $stmt->bindParam(':fuel', $this->fuel);
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':link', $this->link);

            if($stmt->execute())
            {
                return true;
            }
            printf("Error: %s \n", $stmt->error);
            return false;
        }
    }
?>