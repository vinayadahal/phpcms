<?php

function get_css($cssName = NULL) {
    $files = scandir('css/');
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        } elseif (isset($cssName) && $cssName == $file) {
            $cssLinks = '<link href="' . baseUrl . 'css/' . $file . '" rel="stylesheet" type="text/css" />';
            return $cssLinks;
        } else {
            $cssLinks[] = '<link href="' . baseUrl . 'css/' . $file . '" rel="stylesheet" type="text/css" />';
        }
    }
    return $cssLinks;
}

function get_js($jsName = NULL) {
    $files = scandir('js/');
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            continue;
        } elseif (isset($jsName) && $jsName == $file) {
            $jsLinks = '<script src="js/' . $file . '" type="text/javascript"></script>';
        } else {
            $jsLinks[] = '<script src="js/' . $file . '" type="text/javascript"></script>';
        }
    }
    return $jsLinks;
}

function getAllFiles($path) { // takes path like: 'js/'
    $files = scandir($path);
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
            
        } else {
            $fileList[strtok($file, '.')] = $file;
        }
    }
    return $fileList;
}
