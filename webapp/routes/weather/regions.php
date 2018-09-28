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
$route["/weather/regions/find-region-where-regionid/{regionid}/{appkey}/{consumerkey}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode
            ((new \Velocious\controllers\WeatherSites($state))->getRegionWhereRegionID());
        return true;
    }
];
$route["/weather/regions/find-region-where-regionid/{regionid}/"] = $route["/weather/regions/find-region-where-regionid/"];
$route["/weather/regions/find-region-where-regionid/{regionid}/"]["Rules"]["Allowed_Request_Types"] = ["POST"];



/** Find all REGIONS where Name LIKE Word/Text **/
$route["/weather/regions/find-all-regions-where-name-like/{nametext}/{resultslimit}/{appkey}/{consumerkey}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode
            ((new \Velocious\controllers\WeatherSites($state))->getAllRegionsWhereNameLike());
        return true;
    }
];
$route["/weather/regions/find-region-where-regionid/"] = $route["/weather/regions/find-region-where-regionid/"];
$route["/weather/regions/find-region-where-regionid/"]["Rules"]["Allowed_Request_Types"] = ["POST"];




