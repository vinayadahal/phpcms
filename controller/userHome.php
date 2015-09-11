<?php

class userHome extends controllers {

    public function __construct() {
        parent::__construct();
    }

    public function main() {
        $this->loadView();
    }

    public function loadView() {
        $this->model->getModel('userModel');
        $result = $this->model->callMethod('getTheme');
        $res = array_shift($result);
        $data['pageTitle'] = ucfirst('home');
        $data['themeRes'] = $res['path'];
        $this->loader->showView($res['path'] . '/_template/header', $data);
        $this->loader->showView($res['path'] . '/index', $data);
        $this->loader->showView($res['path'] . '/_template/footer', $data);
    }

}
