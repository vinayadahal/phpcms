<?php

class settingModel extends models {

    public function applyTheme($apply, $path) {
        $this->model->where('id', '1');
        if ($this->model->update('theme', array('path' => $path, 'active' => $apply))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
