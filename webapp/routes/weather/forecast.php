<?php declare(strict_types=1);  namespace Velocious\routes;

# Inject Dependencies
use Velocious\core\Render;
use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\config\Restricted;


/**
 * FIND FORECASTING FOR SITES/REGIONS/UAA
 */
 
 
/** Find a ThreeHour for a Specific SiteID **/
$route["/weather/forecast/find-threehour-where-siteid/{siteid}/{appkey}/{consumerkey}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode
            ((new \Velocious\controllers\WeatherForecast($state))->getThreeHourForecastForSiteID());
        return true;
    }
];
$route["/weather/forecast/find-threehour-where-siteid/"] = $route["/weather/forecast/find-threehour-where-siteid/{siteid}/{appkey}/{consumerkey}/"];
$route["/weather/forecast/find-threehour-where-siteid/"]["Rules"]["Allowed_Request_Types"] = ["POST"];


