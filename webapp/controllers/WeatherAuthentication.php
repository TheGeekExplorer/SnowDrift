<?php declare(strict_types=1); namespace Velocious\controllers;

use Velocious\core\MimeTypes;
use Velocious\core\Exception;
use Velocious\core\Memory;
use PDO;


class WeatherAuthentication
{
    protected $weatherread_password;
    protected $dbh;
    protected $appkey;
    protected $consumerkey;
    
    
    /**
     * Weather constructor.
     * @param string $article_id
     * @param array $state
     */
    public function __construct (string $appkey=null, string $consumerkey=null) {
        $this->appkey = $appkey;
        $this->consumerkey = $consumerkey;
        
        # Get password for database
        $this->weatherread_password = trim(file_get_contents("/web/credentials/weatherread.txt"));
        
        # Create connection
        $this->dbh = new \PDO('mysql:host=127.0.0.1;port=33306;dbname=weather', "weatherread", $this->weatherread_password);
    }
    
    
    /**
     * Checks that the app has access to the API and the token is not expired
     * @return void
     */
    public function checkTokenIsAuthorised () {
        # Get ThreeHour for Site '33'...
        $stmt = $this->dbh->prepare("CALL check_token_is_authorised(?, ?)");
        
        # Bind the keys to the rquest query
        $stmt->bindParam(1, $this->appkey);
        $stmt->bindParam(2, $this->consumerkey);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt = null;
        $dbh = null;
        
        if ($result[0]['expires'] <= date("Y-m-d H:i:s")) {
            echo json_encode(["error" => "Your keys are not authorised to use this API Endpoint"]); die();
        }
    }
}
