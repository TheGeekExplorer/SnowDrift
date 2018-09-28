<?php declare(strict_types=1); namespace Velocious\controllers;

use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\core\Memory;
use Velocious\controllers\WeatherAuthentication;
use PDO;


class WeatherRegions
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
     * 
     * @return void
     */
    public function getRegionWhereRegionID () {
        # Get ThreeHour for Site '33'...
        $stmt = $this->dbh->prepare("CALL find_all_regions_where_regionid(?)");
        
        # Bind the SiteID param to query
        $stmt->bindParam(1, $this->state['regionid']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt = null;
        $dbh = null;
        
        # Return to Route
        return $result;
    }
    
    
    /**
     * 
     * @return void
     */
    public function getAllRegionsWhereNameLike () {
        # Get ThreeHour for Site '33'...
        $stmt = $this->dbh->prepare("CALL find_all_regions_where_name_like(?, ?)");
        
        # Bind the SiteID param to query
        $stmt->bindParam(1, $this->state['nametext']);
        $stmt->bindParam(2, $this->state['resultslimit']);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt = null;
        $dbh = null;
        
        # Return to Route
        return $result;
    }
}
