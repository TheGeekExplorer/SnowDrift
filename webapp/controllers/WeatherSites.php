<?php declare(strict_types=1); namespace Velocious\controllers;

use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\core\Memory;
use Velocious\controllers\WeatherAuthentication;
use PDO;


class WeatherSites
{
    protected $state;
    protected $weatherread_password;
    protected $dbh;
    
    /**
     * Weather constructor.
     * @param string $article_id
     * @param array $state
     */
    public function __construct (array $state) {
        $this->state = $state;
        
        # Check that the provided keys are authenticated to access the API.
        (new WeatherAuthentication(
            $this->state['appkey'], 
            $this->state['consumerkey']
        ))->checkTokenIsAuthorised();
        
        # Get password for database
        $this->weatherread_password = trim(file_get_contents("/web/credentials/weatherread.txt"));
        
        # Create connection
        $this->dbh = new \PDO('mysql:host=127.0.0.1;port=33306;dbname=weather', "weatherread", $this->weatherread_password);
    }
    
    
    /**
     * Finding a Site by its Site-ID
     * @return void
     */
    public function getSiteByID () {
        # Get ThreeHour for Site '33'...
        $stmt = $this->dbh->prepare("CALL find_all_sites_for_siteid(?)");
        
        # Bind the SiteID param to query
        $stmt->bindParam(1, $this->state['siteid']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt = null;
        $dbh = null;
        
        # Return to Route
        return $result;
    }
    
    
    /**
     * Finding Sites where its Name is LIKE Word/Text
     * @return void
     */
    public function getAllSitesWhereNameLike () {
        # Get ThreeHour for Site '33'...
        $stmt = $this->dbh->prepare("CALL find_all_sites_for_name_like(?, ?)");
        
        # Bind the SiteID param to query
        $this->state['nametext'] .= "%";
        $stmt->bindParam(1, $this->state['nametext']);
        $stmt->bindParam(2, $this->state['resultslimit']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt = null;
        $dbh = null;
        
        # Return to Route
        return $result;
    }
    
    
    /**
     * Finding Sites by the Unitary-Auth-Area-ID
     * @return void
     */
    public function getAllSitesInUnitaryAuthArea () {
        # Get ThreeHour for Site '33'...
        $stmt = $this->dbh->prepare("CALL find_all_sites_for_uaaid(?, ?)");
        
        # Bind the SiteID param to query
        $stmt->bindParam(1, $this->state['uaaid']);
        $stmt->bindParam(2, $this->state['resultslimit']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt = null;
        $dbh = null;
        
        # Return to Route
        return $result;
    }
    
    
    /**
     * Finding Sites by the Region-ID
     * @return void
     */
    public function getAllSitesInRegion () {
        # Get ThreeHour for Site '33'...
        $stmt = $this->dbh->prepare("CALL find_all_sites_for_regionid(?, ?)");
        
        # Bind the SiteID param to query
        $stmt->bindParam(1, $this->state['regionid']);
        $stmt->bindParam(2, $this->state['resultslimit']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt = null;
        $dbh = null;
        
        # Return to Route
        return $result;
    }
    
    
    /**
     * Finding Sites within X Distance of Latitude/Longitude
     * @return void
     */
    public function getAllSitesWithinDistanceOf () {
        # Get ThreeHour for Site '33'...
        $stmt = $this->dbh->prepare("CALL find_all_sites_within_distance_of(?, ?, ?, ?)");
        
        # Bind the SiteID param to query
        $stmt->bindParam(1, $this->state['latitude']);
        $stmt->bindParam(2, $this->state['longitude']);
        $stmt->bindParam(3, $this->state['distance']);
        $stmt->bindParam(4, $this->state['resultslimit']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt = null;
        $dbh = null;
        
        # Return to Route
        return $result;
    }
}
