<?php

class getModel extends models {

    public function getData($tableName, $where = NULL) {
        $this->model->select('*');
        $this->model->from($tableName);
        if (empty($where)) {
            return $this->model->get();
        } else {
            if (!is_array($where)) {
                $this->model->where('id', $where);
                return $this->model->get();
            } else {
                return $this->whereArray($where);
            }
        }
    }

    public function whereArray($where) {
        foreach ($where as $key => $value) {
            $this->model->where($key, $value);
        }
        return $this->model->get();
    }

}
