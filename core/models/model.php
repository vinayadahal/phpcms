<?php

class model extends modelInsert {

    public $dbh;
    public $select;
    public $delete;
    public $from;
    public $where = array();
    public $whereValue;
    public $limit;
    public $modelName;
    public $methodName = array();

    public function loadDatabase() {
        try {
            if (setPersistence == TRUE) {
                $db = new PDO("mysql:host=" . host . ";dbname=" . database, username, password, array(PDO::ATTR_PERSISTENT => true));
            } elseif (setPersistence == FALSE) {
                $db = new PDO("mysql:host=" . host . ";dbname=" . database, username, password);
            } else {
                echo 'Persistence must be set to TRUE or FALSE';
                exit();
            }
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh = $db;
        } catch (PDOException $ex) {
            $exCode = $ex->getCode();
            if ($exCode == '1044') {
                (new error())->noAccess($exCode);
            } elseif ($exCode == '2002') {
                (new error())->noHost($exCode);
            } else {
                (new error())->noDatabase($exCode);
            }
            exit();
        }
    }

    public function getModel($modelName) {
        if (file_exists(modelDir . $modelName . '.php')) {
            require_once modelDir . $modelName . '.php';
            $this->modelName = $modelName;
            $this->checkModelName($modelName, get_declared_classes());
        } else {
            (new error())->noModelError();
            exit();
        }
    }

    public function checkModelName($modelName, $className) {
        if (array_search($modelName, $className)) {
            $methods = get_class_methods($modelName);
            foreach ($methods as $method) {
                if ($method == '__construct') {
                    continue;
                } else {
                    $this->methodName[] = $method;
                }
            }
        } else {
            (new error())->noModelError();
            exit();
        }
    }

    public function callMethod($methodName, $arg = NULL) {
        if (in_array($methodName, $this->methodName)) {
            if ($arg == NULL) {
                return (new $this->modelName())->$methodName();
            } else {
                return call_user_func_array(array(new $this->modelName(), $methodName), $arg);
            }
        } else {
            (new error())->noMethodError();
            exit();
        }
    }

    public function queryMistake($distinct) {
        if (environment == 'development') {
            $caller = debug_backtrace();
            $filename = explode("\\", $caller[0]['file']);
            (new error())->queryError($distinct, end($filename), $caller[0]['line']);
        } else {
            (new error())->queryError();
        }
        exit();
    }

    public function select($col, $distinct = NULL) {
        if (!empty($col)) {
            if ($col == '*') {
                $field = $col;
            } else {
                $field = "`" . implode("`,`", $col) . "`";
            }
            if ($distinct != 'DISTINCT' && $distinct != 'distinct' && $distinct != NULL) {
                $this->queryMistake($distinct);
            } else {
                $query = "SELECT " . $distinct . ' ' . $field;
                $this->select = $query;
            }
        }
    }

    public function delete() {
        $query = "DELETE";
        $this->delete = $query;
    }

    public function update($table, $col = NULL) { // col name takes array as input
        $where = $this->checkWhere();
        $queryStr = $vals = '';
        $i = 1;
        foreach ($col as $key => $value) {
            $queryStr .= '`' . $key . '`' . ' = ' . "'" . $value . "'";
            $vals .= $value;
            if (count($col) > $i) {
                $queryStr .= ', ';
            }
            $vals .= ', ';
            $i++;
        }
        try {
            $query = "UPDATE $table SET $queryStr " . $where;
            $this->loadDatabase();
            $bind = $this->dbh->prepare($query);
            for ($i = 0; $i < count($this->whereValue); $i++) {
                $bind->bindParam($i + 1, $this->whereValue[$i]);
            }
            return $bind->execute();
        } catch (PDOException $exception) {
            echo "Failed: " . $exception->getMessage();
        }
    }

    public function from($tableName) {
        $query = " FROM `$tableName` ";
        $this->from = $query;
    }

    public function where($id, $value) {
        $query = " `$id` = ? ";
        $this->whereValue[] = $value;
        $this->where[] = $query;
    }

    public function limit($start = NULL, $end = NULL) {
        $this->limit = ' LIMIT ' . $start . $end;
    }

    public function get() {
        $where = $this->checkWhere();
        $query = $this->select . $this->from . $where . $this->limit;
        $this->loadDatabase();
        $bind = $this->dbh->prepare($query);
        $this->dbh = NULL; // closing DB connection
        for ($i = 0; $i < count($this->whereValue); $i++) {
            $bind->bindParam($i + 1, $this->whereValue[$i]);
        }
        $bind->execute();
        return $bind->fetchAll(PDO::FETCH_ASSOC);
    }

    public function remove() {
        $where = $this->checkWhere();
        $query = $this->delete . $this->from . $where;
        $this->loadDatabase();
        $bind = $this->dbh->prepare($query);
        $this->dbh = NULL; // closing DB connection
        for ($i = 0; $i < count($this->whereValue); $i++) {
            $bind->bindParam($i + 1, $this->whereValue[$i]);
        }
        $bind->execute();
        if ($bind->execute()) {
            return TRUE;
        }
    }

    public function checkWhere() {
        if (count($this->where) != 0) {
            $where = 'WHERE';
        } else {
            $where = NULL;
        }
        for ($i = 0; $i < count($this->where); $i++) {
            if (count($this->where) > 1) {
                $exeStat = $i + 1;
                $where .= $this->exeStatSelect($exeStat, $i);
            } else {
                $where .=$this->where[$i];
            }
        }
        return $where;
    }

    public function exeStatSelect($exeStat, $i) {
        if ($exeStat < count($this->where)) {
            return $this->where[$i] . ' AND ';
        } else {
            return $this->where[$i];
        }
    }

}
