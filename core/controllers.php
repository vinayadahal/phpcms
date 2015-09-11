<?php

class controllers extends models {

    public $error;
    public $mapper;
    public $loader;
    public $utils;
    public $secure;
    public $images;

    public function __construct() {
        parent::__construct();
        $this->utils = new utils();
        $this->secure = new secure();
        $this->error = new error();
        $this->mapper = new mapper();
        $this->loader = new loader();
        $this->image = new image();
    }

}
