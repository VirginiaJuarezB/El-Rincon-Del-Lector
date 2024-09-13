<?php

class DataBaseConnection {

    //La clase DataBaseConnection se encarga de crear, recuperar y cerrar la conexión con la base de datos

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $baseDatos = "lectores";
    public  $connection;

    function __construct() {
        $this->createConnection();
    }

    function createConnection() {
        $this->connection = mysqli_connect($this->host, $this->user, $this->pass, $this->baseDatos);
        if (mysqli_connect_errno()) { 
            die("Fallo de conexión: " . mysqli_connect_error()); 
        } 
    }

    public function getConnection() {
        return $this->connection;
    }

    function closeConnection() { 
        mysqli_close($this->connection);
    }
}

?>
