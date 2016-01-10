<?php

namespace Database;

use PDO;
use PDOException;

class MySql implements Driver
{
    private $fetchStyle = PDO::FETCH_ASSOC;

    private $connectionString;
    private $username;
    private $password;
    private $connection;

    public function __construct($connectionString, $username, $password)
    {
        $this->connectionString = $connectionString;
        $this->username = $username;
        $this->password = $password;
    }

    public function query($sql, $parameters)
    {
        return $this->prepareAndExecuteQuery($sql, $parameters)->fetch($this->fetchStyle);
    }

    public function queryAll($sql, $parameters)
    {
        return $this->prepareAndExecuteQuery($sql, $parameters)->fetchAll($this->fetchStyle);
    }

    private function isConnected()
    {
        return $this->connection instanceof PDO;
    }

    private function prepareStatement($sql)
    {
        $this->connect();

        try {
            return $this->connection->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        } catch (PDOException $ex) {
            throw new DriverException('Could not prepare query');
        }
    }

    private function connect()
    {
        if ($this->isConnected()) {
            return;
        }

        try {
            $this->connection = new PDO(
                $this->connectionString,
                $this->username,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $ex) {
            throw new DriverException('Could not connect to database');
        }
    }

    private function prepareAndExecuteQuery($sql, $parameters)
    {
        $statement = $this->prepareStatement($sql);

        try {
            $statement->execute($parameters)
        } catch (PDOException $ex) {
            throw new DriverException('Could not execute query');
        }

        return $statement;
    }
}
