<?php declare(strict_types=1);  namespace Velocious\routes;

# Inject Dependencies
use Velocious\core\Render;
use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\config\Restricted;



/**
 * FIND ALL SITES IN SITEID/REGION/UAA/COUNTRY/CONTINENT
 */

 

/** 
 * Find a Site by its SiteID 
 **/
$route["/weather/sites/find-site-where-siteid/{siteid}/{appkey}/{consumerkey}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode((new \Velocious\controllers\WeatherSites($state))->getSiteByID());
        return true;
    }
];
$route["/weather/sites/find-site-where-siteid/"] = $route["/weather/sites/find-site-where-siteid/{siteid}/{appkey}/{consumerkey}/"];
$route["/weather/sites/find-site-where-siteid/"]["Rules"]["Allowed_Request_Types"] = ["POST"]; 



/** 
 * Find a Site where its name is Like some Text 
 **/
$route["/weather/sites/find-all-sites-where-name-like/{nametext}/{resultslimit}/{appkey}/{consumerkey}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode((new \Velocious\controllers\WeatherSites($state))->getAllSitesWhereNameLike());
        return true;
    }
];
$route["/weather/sites/find-all-sites-where-name-like/"] = $route["/weather/sites/find-all-sites-where-name-like/{nametext}/{resultslimit}/{appkey}/{consumerkey}/"];
$route["/weather/sites/find-all-sites-where-name-like/"]["Rules"]["Allowed_Request_Types"] = ["POST"]; 



/** 
 * Find all sites in REGION 
 **/
$route["/weather/sites/find-all-sites-where-regionid/{regionid}/{resultslimit}/{appkey}/{consumerkey}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode((new \Velocious\controllers\WeatherSites($state))->getAllSitesInRegion());
        return true;
    }
];
$route["/weather/sites/find-all-sites-where-regionid/"] = $route["/weather/sites/find-all-sites-where-regionid/{regionid}/{resultslimit}/{appkey}/{consumerkey}/"];
$route["/weather/sites/find-all-sites-where-regionid/"]["Rules"]["Allowed_Request_Types"] = ["POST"]; 



/** 
 * Find all sites in UAA 
 **/
$route["/weather/sites/find-all-sites-where-unitary-auth-area-id/{uaaid}/{resultslimit}/{appkey}/{consumerkey}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode((new \Velocious\controllers\WeatherSites($state))->getAllSitesInUnitaryAuthArea());
        return true;
    }
];
$route["/weather/sites/find-all-sites-where-unitary-auth-area-id/"] = $route["/weather/sites/find-all-sites-where-unitary-auth-area-id/{uaaid}/{resultslimit}/{appkey}/{consumerkey}/"];
$route["/weather/sites/find-all-sites-where-unitary-auth-area-id/"]["Rules"]["Allowed_Request_Types"] = ["POST"]; 



/** 
 * Find all sites within distance of 
 **/
$route["/weather/sites/find-all-sites-where-within-distance-of/{latitude}/{longitude}/{distance}/{resultslimit}/{appkey}/{consumerkey}/"] = [
    "Rules" => ["Allowed_Request_Types" => ["GET"], "Secure" => 1],
    "Controller"  => function (array $state) : bool {
        MimeTypes::JSON();
        echo json_encode((new \Velocious\controllers\WeatherSites($state))->getAllSitesWithinDistanceOf());
        return true;
    }
];
$route["/weather/sites/find-all-sites-where-within-distance-of/"] = $route["/weather/sites/find-all-sites-where-within-distance-of/{latitude}/{longitude}/{distance}/{resultslimit}/{appkey}/{consumerkey}/"];
$route["/weather/sites/find-all-sites-where-within-distance-of/"]["Rules"]["Allowed_Request_Types"] = ["POST"]; 

