<?php

namespace PHREAPI\kernel\utils\interfaces\database;

use PDO;
use PDOException;
use PHREAPI\kernel\utils\exceptions\DatabaseConnectionException;
use PHREAPI\kernel\utils\exceptions\UnexpectedParameterTypeException;

/**
 *
 */
class MySQL implements DatabaseConnectable {

    /**
     * MySQL constructor.
     *
     * @param string $host If the host has been set to `localhost` it will try to access a socket and if it's `127.0.0.1` it will try to connect via IP-Address and Port.
     * @param string $user
     * @param string $password
     * @param string $database
     * @param integer $port
     */
    public function __construct(string $host, string $user, string $password, string $database, int $port = 3306) {
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
        // if modelClass is given use PDO::FETCH_CLASS cause it will feed the data into a given Class that has the same attributes as the database-table.
        return $this->data->fetchObject($modelClass ?? "stdClass");
    }
}

?>
