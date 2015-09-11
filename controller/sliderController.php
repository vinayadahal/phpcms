<?php

class sliderController extends controllers {

    public function __construct() {
        parent::__construct();
        $this->utils->session(); // starts session
    }

    public function slider() {
        $this->loadViewAjax($data = NULL, 'slider');
        $this->utils->compareFiles('images/slideShow', 'images/slidePublish');
    }

    public function loadSlider() {
        $this->model->getModel('imageModel');
        $res = $this->model->callMethod('getData', array(array('type' => 'slider')));
        foreach ($res as $all) {
            if (!file_exists('images/thumbnails/' . basename($all['imgPath']))) {
                $this->image->createThumbnail($all['imgPath'], 'images/thumbnails/');
            }
            $images[] = array('id' => $all['id'], 'caption' => $all['caption'], 'imgPath' => 'images/thumbnails/' . basename($all['imgPath']));
        }
        if (!empty($images)) {
            $data['imagePath'] = $images;
        } else {
            $data['imagePath'] = NULL;
        }
        $this->loader->showView('apanel/slider', $data);
    }

    public function addSlider() {
        $this->loader->showView('apanel/addSlider');
    }

    public function insertSlider() {
        if (!empty($this->secure->post('caption'))) {
            $caption = $this->secure->post('caption');
        }
        $imgFile = $this->secure->file('imgPath');
        if ($this->image->checkImage($imgFile)) {
            $stat = $this->image->uploadResize($imgFile, 'images/slideshow/');
            if ($stat == 'no-upload') {
                echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Image cannot be uploaded</div>';
            } elseif ($stat == 'same') {
                echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Same file cannot be uploaded twice.</div>';
            } else {
                $this->insertData($caption);
            }
        } else {
            echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />File either not an image or file not selected.</div>';
        }
    }

    public function insertData($caption) {
        $this->image->resizeImage(700);
        $filePath = $this->image->makeImage();
        if (!empty($filePath)) {
            $this->model->getModel('imageModel');
            if ($this->model->callMethod('insertImage', array($caption, $filePath, 'slider'))) {
                echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/adminIcons/tick.png" height="20" width="20" />Image saved</div>';
            } else {
                echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Image cannot be saved</div>';
            }
        }
    }

    public function editSlider() {
        $this->model->getModel('imageModel');
        $res = $this->model->callMethod('getData', array($this->secure->get('id')));
        foreach ($res as $result) {
            $data['id'] = $result['id'];
            $data['caption'] = $result['caption'];
            $data['imgPath'] = $result['imgPath'];
            $data['type'] = $result['type'];
        }
        $this->loader->showView('apanel/editSlider', $data);
    }

    public function updateSlider() {
        $imgPath = $this->secure->post('imgPath');
        $imgId = $this->secure->post('imgId');
        $caption = $this->secure->post('caption');
        $coordX = $this->secure->post('x');
        $coordY = $this->secure->post('y');
        $coordW = $this->secure->post('w');
        $coordH = $this->secure->post('h');
        $filePath = $this->image->cropImage($imgPath, $coordX, $coordY, $coordW, $coordH, 700, 350, 'images/slidePublish/');
        if (!empty($filePath)) {
            $this->model->getModel('imageModel');
            if ($this->model->callMethod('updateSlider', array(ucfirst($caption), $filePath, $imgId))) {
                echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/adminIcons/tick.png" height="20" width="20" />Image published</div>';
            } else {
                echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Image cannot be published</div>';
            }
        } else {
            echo 'file path is empty';
        }
    }

    public function deleteSlider() {
        $id = $this->secure->get('id');
        $this->model->getModel('imageModel');
        $res = $this->model->callMethod('getData', array($id));
        foreach ($res as $result) {
            if (unlink(rootDir . '/' . $result['imgPath'])) {
                $this->deleteData($id);
            } else {
                echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Error deleting image.</div>';
            }
        }
    }

    public function deleteData($id) {
        $this->model->getModel('imageModel');
        if ($this->model->callMethod('deleteSlider', array('images', $id))) {
            echo '<div class="flash_data_ok" id="success"><img src="' . baseUrl . 'images/adminIcons/tick.png" height="20" width="20" />Image deleted</div>';
        } else {
            echo '<div class="flash_data_err" id="success"><img src="' . baseUrl . 'images/adminIcons/warning_shield_grey.png" height="20" width="20" />Image cannot be deleted</div>';
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
