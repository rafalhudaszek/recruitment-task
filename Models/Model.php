<?php

namespace Model;

use PDO;
use PDOStatement;

abstract class Model
{
    const DB_HOST = 'DB_HOST';
    const DB_PORT = 'DB_PORT';
    const DB_DATABASE = 'DB_DATABASE';
    const DB_USERNAME = 'DB_USERNAME';
    const DB_PASSWORD = 'DB_PASSWORD';

    protected PDO $databaseConnection;

    function __construct(
        protected string $tableName
    ) {
        $this->connect();
    }

    protected function connect(): void {
        $this->databaseConnection = new PDO(
            'mysql:host=' . getenv(self::DB_HOST) . ';dbname=' . getenv(self::DB_DATABASE),
            getenv(self::DB_USERNAME),
            getenv(self::DB_PASSWORD)
        );
    }

    protected function execute(string $query): PDOStatement {
        return $this->databaseConnection->query($query);
    }
}