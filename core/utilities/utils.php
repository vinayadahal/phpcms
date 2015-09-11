<?php

class utils {

    public $flashKey;

    public function session() {
        session_start();
    }

    public function setFlashData($key, $value) {
        $_SESSION[$key] = $value;
        unset($_SESSION[$this->flashKey]);
    }

    public function getFlashData($key) {
        if (!empty($_SESSION[$key])) {
            $val = $_SESSION[$key];
            $this->flashKey = $key;
            unset($_SESSION[$key]);
            return $val;
        }
    }

    public function setUserData($array) {
        foreach ($array as $var => $value) {
            $_SESSION[$var] = $value;
        }
    }

    public function getUserData($key) {
        return $_SESSION[$key];
    }

    public function unSetUserData($key) {
        $_SESSION[$key] = '';
    }

    public function destroySession() {
        session_unset();
        session_destroy();
        session_write_close();
    }

    public function sendEmail($to, $from, $subject, $message) {
        $headers = "From: " . $from . "\r\n Content-type: text/html; charset=iso-8859-1\r\n";
        if (mail($to, $subject, $message, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function compareFiles($mainPath, $userPath) {
        $mainFile = scandir(rootDir . '/' . $mainPath);
        $tempFile = scandir(rootDir . '/' . $userPath);
        $mainDir = $this->searchFolder($mainFile);
        $userDir = $this->searchFolder($tempFile);
        if ($mainDir && $userDir) {
            $data = array_diff($userDir, $mainDir);
            foreach ($data as $rmImg) {
                unlink(rootDir . '/' . $userPath . '/' . $rmImg);
            }
        }
    }

    public function searchFolder($files) {
        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            } else {
                $thumbData[] = $file;
            }
        }
        if (!empty($thumbData)) {
            return $thumbData;
        } else {
            return FALSE;
        }
    }

}
