<?php

namespace PHREAPI\kernel\utils\interfaces\database;

use PDO;
use PDOException;
use PHREAPI\kernel\utils\exceptions\DatabaseConnectionException;
use PHREAPI\kernel\utils\exceptions\UnexpectedParameterTypeException;
use PHREAPI\kernel\utils\ConfigLoader;

/**
 *
 */
class MySQL implements DatabaseConnectable {

    /**
     * MySQL constructor.
     */
    public function __construct() {
        $host = ConfigLoader::get("DB_HOST") ?? "127.0.0.1";
        $user = ConfigLoader::get("DB_USER") ?? "root";
        $password = ConfigLoader::get("DB_PASSWORD") ?? "";
        $database = ConfigLoader::get("DB_DATABASE") ?? "phre-api";
        $port = ConfigLoader::get("DB_PORT") ?? 3306;

        $dsn = "mysql:host=$host;dbname=$database;port=$port";
        try {
            $this->driver = new PDO($dsn, $user, $password);
            $this->driver->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            throw new DatabaseConnectionException();
        }
    }

    public function execute(string $statement, $dataArray = null): MySQL {
        if(!is_null($dataArray) && !is_array($dataArray)) throw new UnexpectedParameterTypeException();

        if(is_null($dataArray)) {
            $sth = $this->driver->prepare($statement);
            $sth->execute();
            $this->data = $sth;
        }
        $sth = $this->driver->prepare($statement);
        $sth->execute($dataArray);
        return $this;
    }

    public function asAssoc() {
        return $this->data->fetchAll(PDO::FETCH_ASSOC);
    }

    public function asObject(string $modelClass = null) {
        $fetchedObjects = [];
        // if modelClass is given use PDO::FETCH_CLASS cause it will feed the data into a given Class that has the same attributes as the database-table.
        while($data = $this->data->fetchObject($modelClass ?? "stdClass")) {
            array_push($fetchedObjects, $data);
        }
        return $fetchedObjects;
    }
}

?>
