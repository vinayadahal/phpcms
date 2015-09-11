<?php

class commonModel extends models {

    public function getHeader($id) {
        $this->model->select('*');
        $this->model->from('user');
        $this->model->where('id', $id);
//        $this->model->where('password', sha1('admin'));
        return $this->model->get();
    }

    public function getFooter() {
        $this->model->select('*');
        $this->model->from('pages');
        $this->model->where('menuName', 'copyright');
        return $this->model->get();
    }

}
