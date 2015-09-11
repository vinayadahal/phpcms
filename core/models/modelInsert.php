<?php

class modelInsert {

    public function insert($table, $col = NULL) {
        $info = array_values($col);
        $field = "`" . implode("`,`", array_keys($col)) . "`";
        $cnt = count($col);
        for ($i = 0; $i < $cnt; $i++) {
            $bind_val[] = '?';
        }
        $b_val = implode(",", $bind_val);
        $query = "INSERT INTO $table ($field)VALUES($b_val);";
        $this->loadDatabase();
        $bind = $this->dbh->prepare($query);
        for ($i = 0; $i < $cnt; $i++) {
            $bind->bindParam($i + 1, $info[$i]);
        }
        $this->dbh = NULL; // closing DB connection
        try {
            $result = $bind->execute();
        } catch (Exception $ex) {
            if ($ex->getCode() == '23000') {
                (new error())->insertQueryError();
            }
            exit();
        }
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    }

}
