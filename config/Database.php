<?php

namespace config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $db_name = 'myblog';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect() 
    {
      $this->conn = null;

      try { 
        $dsn = "mysql:host={$this->host};dbname={$this->db_name}";

        $this->conn = new PDO($dsn, $this->username, $this->password);
        
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
}