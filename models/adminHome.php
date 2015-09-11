<?php

class adminHome extends models {

    public function checkMenu() {
        $this->model->select('*');
        $this->model->from('menu');
        return $this->model->get();
    }

}
