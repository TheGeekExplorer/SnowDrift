<?php declare(strict_types=1);  namespace Velocious\routes;

# Inject Dependencies
use Velocious\core\Render;
use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\config\Restricted;




/**
 * STATISTICS for sites
 */

 # ThreeHour Averages for SiteID
$route["/weather/stats/forecast/threehour/{siteid}/{fromdatetime}/{todatetime}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET", "POST"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode
            ((new \Velocious\controllers\WeatherStats($state))->getThreeHourStatsForSiteID());
        return true;
    }
];
