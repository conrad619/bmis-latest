<?php

$city_name = 'Davao';
$location_lati ='7.0736';
$location_long ='125.6110';
$api_key = '06cb8606afdc33b8ec1f464c00e657fc';

//$api_url = 'https://api.openweathermap.org/data/2.5/weather?lat='.$location_lati.'{lat}&lon='.$location_long.'&appid='.$api_key;
$api_url = 'https://api.openweathermap.org/data/2.5/weather?q='.$city_name.'&appid='.$api_key;

$weather_data = json_decode(file_get_contents($api_url), true);

$temperature = $weather_data['main']['temp'];
$weathertype = $weather_data['weather'][0]['main'];

$temperature_in_celsius = $temperature - 273.15;

//echo $temperature;

print_r($weathertype);
echo round ($temperature_in_celsius);

echo "<pre>";
print_r($weather_data);

// https://api.openweathermap.org/data/2.5/weather?lat={lat}&lon={lon}&appid={API key}