<?php

class mapper {

    public $loader;

    function __construct() {
        $this->loader = new loader();
    }

    public function getController($requestFile, $path) {
        if (array_key_exists($requestFile, $path)) {
            $result = explode('/', $path[$requestFile]);
            if (count($result) != 3 && count($result) != 2) {
                return 'ctrlError';
            } elseif (count($result) == 3) {
                return array('controller' => $result[0], 'function' => $result[1], 'argument' => $result[2]);
            } elseif (count($result) == 2) {
                return array('controller' => $result[0], 'function' => $result[1]);
            }
        } else {
            return '404';
        }
    }

}
