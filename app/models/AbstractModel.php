<?php

namespace app;

use ArrayIterator;
use PDOStatement;
use app;

/**
 * Class AbstractModel
 * @package shfretak\models
 */
class AbstractModel
{

    const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;

    const DATA_TYPE_STR = \PDO::PARAM_STR;

    const DATA_TYPE_INT = \PDO::PARAM_INT;

    const DATA_TYPE_FLOAT = 5;

    /**
     * @return string
     */
    public function creatPramsName()
    {
        $pramsName = '';
        foreach (static::$tableSchema as $columnNames => $columnName)
            $pramsName .= $columnNames . "=:" . $columnNames . ", ";
        return trim($pramsName, ', ');
    }

    /**
     * @param PDOStatement $stat
     */
    public function preparePramsName(PDOStatement &$stat)
    {
        foreach (static::$tableSchema as $columnName => $value) {
            if ($value == 5) {
                $filterValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stat->bindValue(":{$columnName}", $filterValue);
            } else {
                $stat->bindValue(":{$columnName}", $this->$columnName, $value);
            }
        }
    }

    /**
     * @return bool
     */
    public function create()
    {
        $sql = "INSERT INTO " . static::$tableName . " SET " . static::creatPramsName();
        $stat = DatabaseHandler::factory()->prepare($sql);
        $this->preparePramsName($stat);
        if ($stat->execute()) {
            $this->{static::$primeryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function update()
    {
        $sql = "UPDATE " . static::$tableName . " SET " . static::creatPramsName() . " WHERE " . static::$primeryKey . " = '" . $this->{static::$primeryKey} . "'";

        $stat = DatabaseHandler::factory()->prepare($sql);
        $this->preparePramsName($stat);
        return $stat->execute();
    }

    /**
     * @param bool $primaryKeyCheck
     * @return bool|mixed
     */
    public function save($primaryKeyCheck = true)
    {
        if (false === $primaryKeyCheck) {
            return $this->create();
        }
        return $this->{static::$primeryKey} === null ? $this->create() : $this->update();
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        $sql = "DELETE FROM " . static::$tableName . " WHERE " . static::$primeryKey . " = '" . $this->{static::$primeryKey} . "'";
        $stat = DatabaseHandler::factory()->prepare($sql);
        return $stat->execute();
    }

    /**
     * @param int $limit
     * @param bool $isDESC
     * @return ArrayIterator|bool
     */
    public static function getAll($limit = 0, $isDESC = false)
    {
        $sql = "SELECT * FROM " . static::$tableName . ($isDESC ? " ORDER BY ".static::$primeryKey." DESC" : '') . ($limit ? " LIMIT $limit " : '');
        $stat = DatabaseHandler::factory()->prepare($sql);
        $stat->execute();
        if (method_exists(get_called_class(), '__construct')) {
            $results = $stat->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stat->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if ((is_array($results) && !empty($results))) {
            return new ArrayIterator($results);
        };
        return false;
    }

    /**
     * @param $pk
     * @return bool|mixed
     */
    public static function getByPK($pk)
    {
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . static::$primeryKey . ' = "' . $pk . '"';
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if ($stmt->execute() === true) {
            if (method_exists(get_called_class(), '__construct')) {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            return !empty($obj) ? array_shift($obj) : false;
        }
        return false;
    }

    /**
     * @param array $columns
     * @param array $options
     * @return ArrayIterator|bool
     */
    public static function getby(array $columns, $options = array())
    {
        $whereClauseColumns = array_keys($columns);
        $whereClauseValues = array_values($columns);
        $whereClause = [];
        for ($i = 0, $ii = count($whereClauseColumns); $i < $ii; $i++) {
            $whereClause[] = $whereClauseColumns[$i] . ' = "' . $whereClauseValues[$i] . '"';
        }
        $whereClause = implode(' AND ', $whereClause);
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . $whereClause;
        return static::get($sql, $options);
    }

    /**
     * @param $sql
     * @param array $options
     * @return ArrayIterator|bool
     */
    public static function get($sql, $options = array())
    {
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if (!empty($options)) {
            foreach ($options as $columnName => $type) {
                if ($type[0] == 4) {
                    $sanitizedValue = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":{$columnName}", $sanitizedValue);
                } elseif ($type[0] == 5) {
                    if (!preg_match(self::VALIDATE_DATE_STRING, $type[1]) || !preg_match(self::VALIDATE_DATE_NUMERIC, $type[1])) {
                        $stmt->bindValue(":{$columnName}", self::DEFAULT_MYSQL_DATE);
                        continue;
                    }
                    $stmt->bindValue(":{$columnName}", $type[1]);
                } else {
                    $stmt->bindValue(":{$columnName}", $type[1], $type[0]);
                }
            }
        }
        $stmt->execute();
        if (method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if (is_array($results) && !empty($results)) {
            return new ArrayIterator($results);
        }

        return false;
    }

    /**
     * @param $sql
     * @param array $options
     * @return bool|mixed
     */
    public static function getOne($sql, $options = array())
    {
        $result = static::get($sql, $options);
        return $result === false ? false : $result->current();
    }


    /**
     * the count the number of the recorders in the table
     * @return int
     * */
    public static function count()
    {
        $sql = 'SELECT COUNT(*) FROM ' . static::$tableName;
        $statment = DatabaseHandler::factory()->prepare($sql);
        $statment->execute();
        return (int)$statment->fetchColumn();

    }

}