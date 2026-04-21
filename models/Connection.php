<?php
class Connection
{
    protected $conn;
    private $configFile = "conf.json";

    public function __construct()
    {
        $this->makeConnection();
    }

    private function makeConnection()
    {
        $configDATA = file_get_contents($this->configFile);
        $c = json_decode($configDATA, true);

        $dsn = "mysql:host=" . $c["host"] . ";dbname=" . $c["db"] . ";charset=utf8mb4";
        $this->conn = new PDO($dsn, $c["userName"], $c["password"]);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConn()
    {
        return $this->conn;
    }
}
?>