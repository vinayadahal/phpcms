<?php

class pagesModel extends models {

    public function getData($id = NULL, $limit = NULL, $start = NULL) {
        $this->model->select('*');
        $this->model->from('pages');
        if (!empty($id)) {
            $this->model->where('id', $id);
        }
        if (!empty($limit)) {
            $this->model->limit($limit);
        }
        return $this->model->get();
    }

    public function insertPage($title, $content, $desc, $menuName) {
        $data = array('title' => $title, 'content' => $content, 'desc' => $desc, 'menuName' => $menuName);
        if ($this->model->insert('pages', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updatePage($title, $content, $desc, $menuName, $editId) {
        $data = array('title' => $title, 'content' => $content, 'desc' => $desc, 'menuName' => $menuName);
        $this->model->where('id', $editId);
        if ($this->model->update('pages', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deletePage($tableName, $where) {
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
