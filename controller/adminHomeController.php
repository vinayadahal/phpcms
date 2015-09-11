<?php

class adminHomeController extends controllers {

    public function __construct() {
        parent::__construct();
        $this->utils->session(); // starts session
    }

    public function main() {
        $this->loadView($data = NULL, 'home');
    }

    public function login() {
        $data['pageTitle'] = 'Login';
        $this->loader->showView('_template/header', $data);
        $this->loader->showView('apanel/login');
        $this->loader->showView('_template/footer', $data);
    }

    public function loadView($data, $pageName = NULL) {
        $data['pageTitle'] = ucfirst($pageName);
        $this->model->getModel('commonModel'); // loading model
        $resultHeader = $this->model->callMethod('getHeader', array($this->utils->getUserData('userId'))); // calling method from model
        if (!empty($resultHeader)) {
            foreach ($resultHeader as $res) {
                $data['name'] = $res['name'];
                $data['gender'] = $res['gender'];
                $data['role'] = $res['role'];
            }
        } else {
            redirect(baseUrl . 'apanel/login', 'refresh');
        }
        $resultFooter = $this->model->callMethod('getFooter');
        foreach ($resultFooter as $res) {
            $data['copyright'] = $res['content'];
        }
        $this->loader->showView('_template/header', $data);
        $this->loader->showView('_template/popup');
        $this->loader->showView('apanel/home', $data);
        $this->loader->showView('_template/footer', $data);
    }

    public function loginCheck() {
        $username = $this->secure->post('username');
        $password = $this->secure->post('password');
        $this->model->getModel('loginModel');
        $res = $this->model->callMethod('get', array($username, $password));
        if (!empty($res)) {
            foreach ($res as $result) {
                $this->utils->setUserData(array('userId' => $result['id'],));
                redirect(baseUrl . 'apanel/home', 'refresh');
            }
        } else {
            redirect(baseUrl . 'apanel/login', 'refresh');
        }
    }

    public function logout() {
        $this->utils->unSetUserData('userId');
        if (!empty($this->utils->setUserData('userId'))) {
            echo 'logout error';
        } else {
            redirect(baseUrl . 'apanel/login', 'refresh');
            $this->utils->destroySession();
        }
    }

}
