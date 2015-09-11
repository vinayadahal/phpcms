<?php

class loginModel extends models {

    public function get($username, $password) {
        $this->model->select('*');
        $this->model->from('user');
        $this->model->where('username', $username);
        $this->model->where('password', sha1($password));
        $this->model->limit(1);
        return $this->model->get();
    }

}
