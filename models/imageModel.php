<?php

class imageModel extends models {

    public function getData($where = NULL) {
        $this->model->select('*');
        $this->model->from('images');
        if (empty($where)) {
            return $this->model->get();
        } else {
            if (!is_array($where)) {
                $this->model->where('id', $where);
                return $this->model->get();
            } else {
                foreach ($where as $key => $value) {
                    $this->model->where($key, $value);
                }
                return $this->model->get();
            }
        }
    }

    public function insertImage($caption, $imgPath, $type) {
        $data = array('caption' => $caption, 'imgPath' => $imgPath, 'type' => $type);
        if ($this->model->insert('images', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function updateSlider($caption, $userPath, $imgId) {
        $this->model->where('id', $imgId);
        if ($this->model->update('images', array('caption' => $caption, 'userPath' => $userPath))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteSlider($tableName, $where) {
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
