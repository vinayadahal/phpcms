<?php

class menuModel extends models {

    public function getNavInfo($where = NULL) {
        $this->model->select('*');
        $this->model->from('menu');
        if (empty($where)) {
            return $this->model->get();
        } else {
            $this->model->where('id', $where);
            return $this->model->get();
        }
    }

    public function insertMenu($menuName, $desc) {
        if ($this->model->insert('menu', array('menuName' => $menuName, 'desc' => $desc))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateMenu($menuName, $desc, $editId) {
        $this->model->where('id', $editId);
        if ($this->model->update('menu', array('menuName' => $menuName, 'desc' => $desc))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteMenu($tableName, $where) {
        $this->model->delete();
        $this->model->from($tableName);
        $this->model->where('id', $where);
        if ($this->model->remove()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
