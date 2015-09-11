<?php

class settingController extends controllers {

    public function __construct() {
        parent::__construct();
        $this->utils->session(); // starts session
    }

    public function main() {
        $this->loadView($data = null, 'setting');
    }

    public function theme() {
        $allFolder = scandir(rootDir . '/view/theme');
        foreach ($allFolder as $folders) {
            if ($folders == '.' || $folders == '..') {
                continue;
            } else {
                $allThemeFolder[$folders] = scandir(rootDir . '/view/theme/' . $folders);
            }
        }
        if (!empty($allThemeFolder)) {
            $data['preview'] = $allThemeFolder;
        } else {
            echo 'There is no theme folder';
            $data = NULL;
        }
        $this->loadView($data, 'theme');
    }

    public function themeSet() {
        $apply = $this->secure->get('apply');
        $path = $this->secure->get('path');
        if (!empty($apply) && !empty($path)) {
            $apply = 'yes';
            $this->model->getModel('settingModel');
            $result = $this->model->callMethod('applyTheme', array($apply, $path));
            if($result){
                echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/adminIcons/tick.png" height="20" width="20" />Theme applied</div>';
            }
        }
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
