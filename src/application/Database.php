<?php

namespace src\application;

use PDO;

class Database
{
    private static $pdo;
    private $sQuery;
    private $bConnected = false;
    private $parameters;

    private function __construct()
    {
        $config = require 'database_config.php';
        $this->pdo = new PDO('mysql:dbname=' . $config['name'] . ';host=' . $config['host'] . ';port=' . $config['port'] . ';charset=utf8',
            $config['user'],
            $config['password'],
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND       => "SET NAMES utf8",
                PDO::ATTR_EMULATE_PREPARES         => false,
                PDO::ATTR_ERRMODE                  => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
            )
        );

        return $this->pdo;
    }

    public function query($query, $params = null, $fetchmode = PDO::FETCH_ASSOC)
    {
        $query = trim($query);
        $rawStatement = explode(" ", $query);
        $this->init($query, $params);
        $statement = strtolower($rawStatement[0]);

        if ($statement === 'select' || $statement === 'show') {
            return $this->sQuery->fetchAll($fetchmode);
        } else {
            if ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
                return $this->sQuery->rowCount();
            } else {
                return null;
            }
        }
    }

    private function init($query, $parameters)
    {
        if ( ! $this->bConnected) {
            $this->Connect();
        }

        $this->parameters = $parameters;
        $this->sQuery = $this->pdo->prepare($this->buildParams($query, $this->parameters));

        if ( ! empty($this->parameters)) {
            if (array_key_exists(0, $parameters)) {
                $parametersType = true;
                array_unshift($this->parameters, "");
                unset($this->parameters[0]);
            } else {
                $parametersType = false;
            }
            foreach (array_keys($this->parameters) as $column) {
                $this->sQuery->bindParam($parametersType ? intval($column) : ":" . $column, $this->parameters[$column]);
            }
        }

        $this->sQuery->execute();
        $this->parameters = array();
    }

    public function connect()
    {
        if (self::$pdo === null) {
            self::$pdo = new self();
        }

        return self::$pdo;
    }

    private function buildParams($query, $params = array())
    {
        if ( ! empty($params)) {
            $arrayParameterFound = false;

            foreach ($params as $parameterKey => $parameter) {
                if (is_array($parameter)) {
                    $arrayParameterFound = true;
                    $in = "";
                    foreach ($parameter as $key => $value) {
                        $namePlaceholder = $parameterKey . "_" . $key;

                        $in .= ":" . $namePlaceholder . ", ";

                        $params[$namePlaceholder] = $value;
                    }
                    $in = rtrim($in, ", ");
                    $query = preg_replace("/:" . $parameterKey . "/", $in, $query);

                    unset($params[$parameterKey]);
                }
            }

            if ($arrayParameterFound) {
                $this->parameters = $params;
            }
        }

        return $query;
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function column($query, $params = null)
    {
        $this->init($query, $params);
        $resultColumn = $this->sQuery->fetchAll(PDO::FETCH_COLUMN);
        $this->sQuery->rowCount();
        $this->sQuery->columnCount();
        $this->sQuery->closeCursor();

        return $resultColumn;
    }

    public function row($query, $params = null, $fetchMode = PDO::FETCH_ASSOC)
    {
        $this->init($query, $params);
        $resultRow = $this->sQuery->fetch($fetchMode);
        $this->sQuery->rowCount();
        $this->sQuery->columnCount();
        $this->sQuery->closeCursor();

        return $resultRow;
    }

    public function single($query, $params = null)
    {
        $this->init($query, $params);

        return $this->sQuery->fetchColumn();
    }
}
