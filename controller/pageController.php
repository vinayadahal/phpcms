<?php

class pageController extends controllers {

    public function __construct() {
        parent::__construct();
        $this->utils->session();
    }

    public function main() {
        $this->loadViewAjax($data = NULL, 'pages');
    }

    public function loadTableData() {
        $this->model->getModel('pagesModel');
        $allResult = $this->model->callMethod('getData');
        foreach ($allResult as $all) {
            $this->model->getModel('menuModel');
            $menuName = $this->model->callMethod('getNavInfo', array($all['menuName']));
            $allData[] = array('id' => $all['id'], 'title' => $all['title'], 'content' => $all['content'], 'desc' => $all['desc'], 'menuName' => $menuName[0]['menuName']);
        }
        if (!empty($allData)) {
            $data['getInfo'] = $allData;
        } else {
            $data['getInfo'] = NULL;
        }
        $this->model->getModel('adminHome');
        if (!empty($this->model->callMethod('checkMenu'))) {
            $data['addBtn'] = 'show';
        } else {
            $data['addBtn'] = 'hide';
        }
        $this->loader->showView('apanel/pages', $data);
    }

    public function addPage() {
        $this->model->getmodel('getModel');
        $fromMenu = $this->model->callMethod('getData', array('menu'));
        $fromPages = $this->model->callMethod('getData', array('pages'));
        var_dump($fromMenu);
        var_dump($fromPages);
//        var_dump(array_diff($fromMenu, $fromPages));
//        foreach ($diff as $diffs) {
//            echo $diffs;
//        }
        $data['menuName'] = NULL;
        $this->loader->showView('apanel/addPage', $data);
    }

    public function insertPage() {
        $title = $this->secure->post('title');
        $content = $this->secure->post('content');
        $desc = $this->secure->post('desc');
        $menuName = $this->secure->post('menuName');
        $this->model->getModel('pagesModel');
        if ($this->model->callMethod('insertPage', array(ucfirst($title), $content, $desc, $menuName))) {
            echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/adminIcons/tick.png" height="20" width="20" />Page saved</div>';
        } else {
            echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Page cannot be saved</div>';
        }
    }

    public function editPage() {
        $this->model->getmodel('menuModel');
        $data['allMenu'] = $this->model->callMethod('getNavInfo');
        $this->model->getModel('pagesModel');
        $editResult = $this->model->callMethod('getData', array($this->secure->get('id')));
        foreach ($editResult as $res) {
            $this->model->getModel('menuModel');
            $menuName = $this->model->callMethod('getNavInfo', array($res['menuName']));
            $data['editId'] = $res['id'];
            $data['title'] = $res['title'];
            $data['content'] = $res['content'];
            $data['desc'] = $res['desc'];
            $data['editMenuId'] = $res['menuName'];
            $data['menuEdit'] = $menuName[0]['menuName'];
        }
        $this->loader->showView('apanel/editPage', $data);
    }

    public function updatePage() {
        $title = $this->secure->post('title');
        $content = $this->secure->post('content');
        $desc = $this->secure->post('desc');
        $menuName = $this->secure->post('menuName');
        $editId = $this->secure->post('editId');
        $this->model->getModel('pagesModel');
        if ($this->model->callMethod('updatePage', array(ucfirst($title), $content, $desc, $menuName, $editId))) {
            echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/adminIcons/tick.png" height="20" width="20" />Page edited</div>';
        } else {
            echo '<div class="flash_data_err" id="failed"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Page cannot be edited</div>';
        }
    }

    public function deletePage() {
        $this->model->getModel('pagesModel');
        if ($this->model->callMethod('deletePage', array('pages', $this->secure->get('id')))) {
            echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/adminIcons/tick.png" height="20" width="20" />Page removed</div>';
        } else {
            echo '<div class="flash_data_err" id="failed"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Page cannot be removed</div>';
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

}
