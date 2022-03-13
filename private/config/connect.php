<?php

require_once('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class DB
{
    // server    
    private $DB_HOST;
    private $DB_USER;
    private $DB_PASSWORD;
    private $DB_PORT;
    private $conn = null;

    public function __construct()
    {
        $this->DB_HOST = $_ENV['DB_HOST'];
        $this->DB_USER = $_ENV['DB_USER'];
        $this->DB_PASSWORD = $_ENV['DB_PASSWORD'];
        $this->DB_PORT = $_ENV['DB_PORT'];
        // $this->print();
        $this->conn = mysqli_connect($this->DB_HOST . ":" . $this->DB_PORT, $this->DB_USER, $this->DB_PASSWORD);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function query(string $query)
    {
        $result = $this->conn->query($query);
        if ($result === TRUE) {
            echo "Query executed successfully";
            return $result;
        } else {
            echo "Error while executing the query: " . $query . ", Error: " . $this->conn->error;
        }
    }

    public function print()
    {
        echo "1-)" . $this->DB_HOST;
        echo "2-)" . $this->DB_USER;
        echo "3-)" . $this->DB_PASSWORD;
        echo "4-)" . $this->DB_PORT;
    }
}

$db = new DB();
