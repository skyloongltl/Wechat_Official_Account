<?php
namespace database\mysql;
class Database{
    public static $instance;
    public $pdo;
    public $is_connect = false;

    public function __construct()
    {
        $config = require DIR . "/database/mysql/db.config.php";
        $dsn = "{$config['DB_TYPE']}:dbname={$config['DB_NAME']};host={$config['DB_HOST']};charset=utf8mb4";
        try{
            $this->pdo = new \PDO($dsn, $config['DB_USER'], $config['DB_PWD']);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->is_connect = true;
        }catch (\PDOException $e){
            echo $e->getMessage();
            $this->is_connect = false;
        }
    }

    public static function getInstance(){
        $key = getmypid();
        self::$instance = array();
        if(!isset(self::$instance[$key])){
            self::$instance[$key] = new self();
        }
        return self::$instance[$key];
    }

    public static function close(){
        $key = getmypid();
        self::$instance[$key] = null;
        unset(self::$instance[$key]);
    }
}