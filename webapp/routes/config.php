<?php declare(strict_types=1);  namespace Velocious\routes;

# Inject Dependencies
use Velocious\core\Render;
use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\config\Restricted;



/**
 * Index Route - Serves up a static HTML files from
 * the ./html/ folder.
**/
$route["/"] = [
    "Rules" => [
        "Allowed_Request_Types" => ["GET"],
        "Allowed_Remote_Addr"   => Restricted::getRemoteAddresses(),
        "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        return Render::file("/public/Welcome.html", "html");
    }
];



/**
 * Load in other routing configuration files
**/

/** SnowDrift APIs **/
include_once('weather/sites.php');
include_once('weather/regions.php');
include_once('weather/unitaryauthareas.php');
include_once('weather/forecast.php');
include_once('weather/stats.php');

/** SMS Engine **/
include_once('sms/sms.php');

/** Mobile APIs **/
#include_once('api/mobile_app_auth_routes.php');
#include_once('api/mobile_app_search_routes.php');