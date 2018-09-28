<?php declare(strict_types=1); namespace Velocious\models\Weather;

use Velocious\core\Exception;
use Velocious\core\MySQL;


class WeatherBase
{
    # Connection Parameters
    public static $HOST;
    public static $PORT;
    public static $DATABASE;
    public static $CHARSET;
    public static $USER;
    public static $PASS;

    /**
     * Save the record
     * @return bool
     */
    public function findAllInFiveDay () {
        $MySQL = new MySQL(self::$HOST, self::$PORT, self::$DATABASE, self::$CHARSET, self::$USER, self::$PASS);
        $db = $MySQL->CONN;

        # Run query in DB
        $stmt    = $db->query("SELECT id, siteid, name, latitude, longitude, elevation, t1, t2, t3, t4, t5 FROM fiveday WHERE name='Northampton' ORDER BY id ASC");
        $results = $stmt->fetch(\PDO::FETCH_ASSOC);

        # Destroy connection.
        $stmt=[]; $db=[]; $MySQL=[];

        # Return results
        return $results;
    }

    /**
     * Delete a record
     * @return bool
     */
    public function delete () {
        return true;
    }


}