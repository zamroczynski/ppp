<?php
    echo 'Dodano nowe pozycje do bazy danych <a href="../index.php"> POWRÓT</a>';
    include('simple_html_dom.php');
    include_once '../config/Database.php';
    $datebase = new Database();
    $db = $datebase->connect();
    $max_page = 1;
    for($i=1; $i <= $max_page; $i++)
    {
        $url = 'https://www.otomoto.pl/osobowe/?page='.$i;
        $page[$i] = file_get_html($url);
    }
    for($i=1; $i <= $max_page; $i++)
    {
        $cars = $page[$i]->find('article');
        $cars_name = $page[$i]->find('div[class="offer-item__title"] h2');
        $cars_year = $page[$i]->find('ul li[data-code="year"]');
        $cars_mileage = $page[$i]->find('ul li[data-code="mileage"]');
        $cars_fuel = $page[$i]->find('ul li[data-code="fuel_type"]');
        $cars_price = $page[$i]->find('span[class="offer-price__number ds-price-number"]');
        $cars_location = $page[$i]->find('h4[class="ds-location hidden-xs"]');


        for($j=0; $j < count($cars, COUNT_RECURSIVE); $j++)
        {
            $query = 'INSERT INTO cars VALUES 
            (NULL, ' .$cars[$j]->getAttribute('data-ad-id').', "'.ltrim($cars_name[$j]->plaintext).'", '.$cars_year[$j]->plaintext.', 
            '.filter_var($cars_mileage[$j]->plaintext, FILTER_SANITIZE_NUMBER_INT).', "'.ltrim($cars_fuel[$j]->plaintext).'", 
            '.filter_var($cars_price[$j]->plaintext, FILTER_SANITIZE_NUMBER_INT).', 
            "'.ltrim($cars_location[$j]->plaintext).'", "'.$cars[$j]->getAttribute('data-href').'")';
            $stmt = $db->prepare($query);
            $stmt->execute();
            echo $query;
            echo '<br/>';
            $query = '';
            echo $cars[$j]->getAttribute('data-ad-id');
            echo '<br/>';
            echo $cars_name[$j]->plaintext;
            echo '<br/>';
            echo $cars_year[$j]->plaintext;
            echo '<br/>';
            echo $cars_mileage[$j]->plaintext;
            echo '<br/>';
            echo $cars_fuel[$j]->plaintext;
            echo '<br/>';
            echo $cars_price[$j]->plaintext;
            echo '<br/>';
            echo $cars_location[$j]->plaintext;
            echo '<br/>';
            echo $cars[$j]->getAttribute('data-href');
            echo '<br/>';
            echo '<br/>';
            echo '<br/>';
            echo '<br/>';
            
        }



    }
    
?>