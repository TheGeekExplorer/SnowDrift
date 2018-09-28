<?php declare(strict_types=1); namespace Velocious\controllers;

use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\core\Memory;
use PDO;


class Weather
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
        
        # Get password for database
        $this->weatherread_password = trim(file_get_contents("/web/credentials/weatherread.txt"));
        
        # Create connection
        $this->dbh = new \PDO('mysql:host=127.0.0.1;port=33306;dbname=weather', "weatherread", $this->weatherread_password);
    }
    
    
    /**
     * POC to get the ThreeHour Forecast for a given site in the URL
     * @return void
     */
    public function getThreeHourStatsForSiteID () {
        # Get ThreeHour for Site '33'...
        $stmt = $this->dbh->prepare("CALL find_avg_and_var_in_threehour_for_siteid_and_date_range(?, ?, ?)");
        
        # Bind the SiteID param to query
        $stmt->bindParam(1, $this->state['siteid']); 
        $stmt->bindParam(2, $this->state['fromdatetime']); 
        $stmt->bindParam(3, $this->state['todatetime']); 
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt = null;
        $dbh = null;
        
        # Return to Route
        return $result;
    }
    
    
    /**
     * POC to get the ThreeHour Forecast Stats for a given site in the URL
     * @return void
     */
    public function getThreeHourForSiteID () {
        # Get ThreeHour for Site '33'...
        $stmt = $this->dbh->prepare("CALL find_threehour_for_siteid(?)");
        
        # Bind the SiteID param to query
        $stmt->bindParam(1, $this->state['siteid']); 
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt = null;
        $dbh = null;
        
        # Return to Route
        return $result;
    }
}
