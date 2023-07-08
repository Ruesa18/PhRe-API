<?php

namespace PHREAPI\kernel\utils\interfaces\database;

use PDO;
use PDOException;
use PDOStatement;
use PHREAPI\kernel\utils\ConfigLoader;
use PHREAPI\kernel\utils\exceptions\DatabaseConnectionException;

class MySQL implements DatabaseConnectable {
    private PDO $driver;

    private ?PDOStatement $data;

    /**
     * MySQL constructor.
     * @throws DatabaseConnectionException
     */
    public function __construct() {
        $host = ConfigLoader::get("DB_HOST");
        $user = ConfigLoader::get("DB_USER");
        $password = ConfigLoader::get("DB_PASSWORD");
        $database = ConfigLoader::get("DB_DATABASE");
        $port = ConfigLoader::get("DB_PORT") ?? 3306;

        $dsn = "mysql:host=$host;dbname=$database;port=$port";
        try {
            $this->driver = new PDO($dsn, $user, $password);
            $this->driver->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException) {
            throw new DatabaseConnectionException();
        }
    }

    public function execute(string $statement, ?array $data = null): self {
        if(is_null($data)) {
            $sth = $this->driver->query($statement);
            $this->data = $sth;
            return $this;
        }
        $sth = $this->driver->prepare($statement);
        $this->data = $sth;
        $sth->execute($data);
        return $this;
    }

    public function asAssoc() {
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function asObjects(string $modelClass = null) {
        $fetchedObjects = [];
        // if modelClass is given, use PDO::FETCH_CLASS because it will feed the data into a given Class that has the same attributes as the database-table.
        while($data = $this->data->fetchObject($modelClass ?? "stdClass")) {
            $fetchedObjects[] = $data;
        }
        return $fetchedObjects;
    }
}
