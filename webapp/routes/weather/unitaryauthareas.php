<?php declare(strict_types=1);  namespace Velocious\routes;

# Inject Dependencies
use Velocious\core\Render;
use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\config\Restricted;


/**
 * FIND ALL SITES IN SITEID/REGION/UAA/COUNTRY/CONTINENT
 */



/** Find a REGION by its RegionID **/
$route["/weather/uaa/find-unitary-auth-area-where-uaaid/{uaaid}/{appkey}/{consumerkey}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode
            ((new \Velocious\controllers\WeatherSites($state))->getRegionWhereRegionID());
        return true;
    }
];
$route["/weather/uaa/find-unitary-auth-area-where-uaaid/"] = $route["/weather/uaa/find-unitary-auth-area-where-uaaid/"];
$route["/weather/uaa/find-unitary-auth-area-where-uaaid/"]["Rules"]["Allowed_Request_Types"] = ["POST"]; 



/** Find all REGIONS where Name LIKE Word/Text **/
$route["/weather/uaa/find-all- unitary-auth-areas-where-name-like/{nametext}/{resultslimit}/{appkey}/{consumerkey}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode
            ((new \Velocious\controllers\WeatherSites($state))->getAllRegionsWhereNameLike());
        return true;
    }
];
$route["/weather/uaa/find-all- unitary-auth-areas-where-name-like/"] = $route["/weather/uaa/find-all- unitary-auth-areas-where-name-like/"];
$route["/weather/uaa/find-all- unitary-auth-areas-where-name-like/"]["Rules"]["Allowed_Request_Types"] = ["POST"]; 




