<?php

class menuController extends controllers {

    public function __construct() {
        parent::__construct();
        $this->utils->session(); // starts session
    }

    public function main() {
        $this->loadView($data = null, 'menu');
    }

    public function navBar() {
        $this->loadViewAjax($data = NULL, 'navBar');
    }

    public function navBarDataTable() {
        $this->model->getModel('menuModel');
        $allResult = $this->model->callMethod('getNavInfo');
        $i = 1;
        foreach ($allResult as $all) {
            $allData[] = array('sn' => $i++, 'id' => $all['id'], 'menuName' => $all['menuName'],
                'desc' => $all['desc'], 'multilevel' => $all['multilevel'], 'parentId' => $all['parentId']);
        }
        if (!empty($allData)) {
            $data['getInfo'] = $allData;
        } else {
            $data['getInfo'] = NULL;
        }
        $this->loader->showView('apanel/' . 'navBar', $data);
    }

    public function addNav() {
        $this->loader->showView('apanel/addNav');
    }

    public function insertNav() {
        $navName = $this->secure->post('navName');
        $desc = $this->secure->post('description');
        $this->model->getModel('menuModel');
        if ($this->model->callMethod('insertMenu', array(ucfirst($navName), ucfirst($desc)))) {
            echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/adminIcons/tick.png" height="20" width="20" />Menu item saved</div>';
        } else {
            echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Menu item cannot be saved</div>';
        }
    }

    public function editNav() {
        $this->model->getModel('menuModel');
        $allResult = $this->model->callMethod('getNavInfo', array($this->secure->get('id')));
        foreach ($allResult as $res) {
            $data['editId'] = $res['id'];
            $data['itemName'] = $res['menuName'];
            $data['desc'] = $res['desc'];
        }
        $this->loader->showView('apanel/editNav', $data);
    }

    public function updateNav() {
        $editId = $this->secure->post('editId');
        $navName = $this->secure->post('navName');
        $desc = $this->secure->post('description');
        $this->model->getModel('menuModel');
        if ($this->model->callMethod('updateMenu', array(ucfirst($navName), ucfirst($desc), $editId))) {
            echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/adminIcons/tick.png" height="20" width="20" />Menu item edited</div>';
        } else {
            echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Menu item cannot be edited</div>';
        }
    }

    public function deleteNav() {
        $this->model->getModel('menuModel');
        if ($this->model->callMethod('deleteMenu', array('menu', $this->secure->get('id')))) {
            echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/adminIcons/tick.png" height="20" width="20" />Menu item removed</div>';
        } else {
            echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Menu item cannot be removed</div>';
        }
    }

    public function loadViewAjax($data, $pageName = NULL) {
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
        $this->loader->showView('apanel/' . $pageName, $data);
        $this->loader->showView('_template/footer', $data);
    }

}
