<?php
class Connection{
    protected $conn;
    private $configFile = "conf.json";

    public function __construct(){
        $this->makeConnection();
    }

    private function makeConnection(){
        $configDATA = file_get_contents ($this->configFile);
        $c = json_decode($configDATA, true);
        $dsn = "mysql:host=" . $c["host"] . ";dbname=" . $c["db"];
        $this->conn = new PDO($dsn, $c["userName"], $c["password"]);
    }

    public function getConn(){
        return $this->conn;
    }
}
