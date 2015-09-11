<?php

class secure {

    public function get($key) {
        return $this->filter($_GET[$key]);
    }

    public function post($key) {
        return $this->filter($_POST[$key]);
    }

    public function file($key) {
        return $_FILES[$key];
    }

    public function filter($value) {
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        } else {
            $value = addslashes($value);
        }
        return $value;
    }

}
