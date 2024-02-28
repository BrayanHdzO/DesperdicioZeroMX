<?php
class Database {
    private static $instance;
    private $connection;

    private function __construct() {
        $this->connection = new mysqli('localhost', 'root', '', 'zerodesperdiciomx');
        if ($this->connection->connect_error) {
            die("Error de conexión: " . $this->connection->connect_error);
        } 
        echo "Conexion exitosa";
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
