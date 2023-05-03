<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styles.css">
        
        <title>
        Weather App 
        </title>
    </head>
    <body>
        <div class="container">
        <div class="header"> 
        <h1>Weather App</h1>
        </div>
        <div class="form-container">
            <form method="post" action="index.php">
                <p>Enter City <input name="city" type="text"></p>
                <button>Submit</button>
            </form>
        </div>
        <div class="form-container">
           
        <?php
        $apiKey = "21f569c00535598be3ffa1d55383da35";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $city = $_POST['city'];
            $url = "https://api.openweathermap.org/data/2.5/weather?q=" . $city . "&units=imperial&appid=" . $apiKey;
            $response = file_get_contents($url);

            $data = json_decode($response, true);
        }
        $main = $data['main']; //main in json 
        $weather = $data['weather']; //weather in json

        $temp = $main['temp'];

        $string = json_encode($data, JSON_PRETTY_PRINT); //shows all weather data

        
        date_default_timezone_set('America/New_York');
        $cur_time = date('h:i A');
        ?>
        <h1><?php echo $city; ?> </h1>
        <hr>
        <p>Feels like <?php echo $main['feels_like']; ?> *F</p>
        <div class="cols">
        <ul class="col">
            <li> Temp: <?php echo $main['temp']; ?> *F</li>
            <li> Max Temp: <?php echo $main['temp_max']; ?> *F</li>
            <li> Min Temp: <?php echo $main['temp_min']; ?> *F</li>                                                                                                                                                                                                                                                                                                                                                       
        </ul>
        <ul class="col">
            <li> Pressure: <?php echo $main['pressure']; ?></li>
            <li> Humidity: <?php echo $main['humidity']; ?> %</li>
            <li> Wind Spd: <?php echo $data['wind']['speed']; ?> MPH</li>                                                                                                                                                                                                                                                                                                                                                       
        </ul >
        </div>
        <p>Lon, Lat: <?php echo $data['coord']['lon']?>, <?php echo $data['coord']['lat']?></p>
        <p> Data as of <?php echo $cur_time; ?> </p>
        </div>
        </div>
    </body>
</html>