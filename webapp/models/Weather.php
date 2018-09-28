<?php declare(strict_types=1); namespace Velocious\models;

use Velocious\models\ModelBase;


class Weather extends ModelBase
{
    # Connection Parameters
    public function __construct ()
    {
        parent::$HOST     = "127.0.0.1";
        parent::$PORT     = "33306";
        parent::$DATABASE = "weather";
        parent::$CHARSET  = "UTF8";
        parent::$USER     = "weatherread";
        parent::$PASS     = "";
    }


    # Model Fields
    public $id;
    public $siteid;
    public $name;
    public $latitude;
    public $longitude;
    public $elevation;
    public $t1;
    public $t2;
    public $t3;
    public $t4;
    public $t5;


    # Constraints of field
    public $constraints = [
        "id"        => ["int", 11],
        "siteid"    => ["varchar", 11],
        "name"      => ["varchar", 255],
        "latitude"  => ["int", 11],
        "longitude" => ["int", 11],
        "elevation" => ["text", 5000],
        "t1"        => ["varchar", 10],
        "t2"        => ["varchar", 10],
        "t3"        => ["varchar", 10],
        "t4"        => ["varchar", 10],
        "t5"        => ["varchar", 10]
    ];
}
