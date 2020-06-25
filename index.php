<?php
function callAPI($method, $url, $data){
    $curl = curl_init();
    switch ($method){
       case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          break;
       case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
          break;
       default:
          if ($data)
             $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
       'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    return $result;
 }
 if(isset($_GET['allOffert']))
 {
     $result = callAPI('GET', 'http://localhost/ppp/api/car/read.php', false);
     $arr = json_decode($result, true);
     $html = '';
     foreach ($arr as $item)
     {
        $html .= "ID= ".$item['id']."<br/>";
        $html .= "Nazwa= ".$item['name']."<br/>";
        $html .= "Rok= ".$item['year']."<br/>";
        $html .= "Przebieg= ".$item['mileage']."<br/>";
        $html .= "Paliwo= ".$item['fuel']."<br/>";
        $html .= "Cena= ".$item['price']."<br/>";
        $html .= "Lokalizacja= ".$item['location']."<br/>";
        $html .= "link= ".$item['link']."<br/>";
        $html .= "<br/><br/>";
     }
 }
 if(isset($_GET['scrap']))
 {
    header("Location: scraper/index.php");
    exit();
 }
?>
<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">

        <title>Projekt Paradygmaty Programowania - Damian Zamroczynski</title>
        <meta name="author" content="Damian Zamroczynski">
    </head>

    <body>
        <form>
            <input type="button" value="Wyczyść DB" /> 
            <br />
            <br />
            <input type="submit" value="Uruchom Scrapera" name="scrap" />
            <br />
            <br />
            <input type="submit" value="Pokaż wszystkie oferty" name="allOffert" />
            <br />
            <br />
        </form>
        <?php
        if(isset($html))
        {
            echo $html;
            unset($htmml);
        }
        ?>
    </body>
</html>