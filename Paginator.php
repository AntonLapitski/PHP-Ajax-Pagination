<?php

class Paginator
{
    public $connection;
    public $step = 5;
    public $config;

    public function __construct()
    {   $this->setConfig();
        $this->createConnection($this->config);
    }

    public function createConnection($config)
    {
        $servername = $config['servername'];
        $username = $config['username'];
        $password = $config['password'];
        $dbname = $config['dbname'];

        $this->connection = new mysqli($servername, $username, $password, $dbname);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getFirstEntries()
    {
        $sql = "SELECT * FROM users LIMIT $this->step";

        $result = $this->connection->query($sql);

        while ($row = $result->fetch_assoc()) {
            $set [] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($set);
    }

    public function getRequestedEntries()
    {
        $offset = $_GET['another'];

        $offset = ($offset - 1) * $this->step;

        $sql = "SELECT * FROM users LIMIT $this->step OFFSET $offset";
        $result = $this->connection->query($sql);

        while ($row = $result->fetch_assoc()) {
            $set [] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($set);
    }

    public function getCount()
    {
        $sql = "SELECT COUNT(*) FROM users";
        $result = $this->connection->query($sql);

        while ($row = $result->fetch_assoc()) {
            $set [] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($set);
    }

    public function setConfig()
    {
        $this->config = require __DIR__ . '/config.php';
    }

}
