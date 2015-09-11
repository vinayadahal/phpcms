<?php

class userModel extends models {

    public function getTheme() {
        $this->model->select('*');
        $this->model->from('theme');
        $this->model->where('active', 'yes');
        $this->model->limit('1');
        return $this->model->get();
    }

}
