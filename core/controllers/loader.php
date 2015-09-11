<?php

class loader {

    public function compress($buffer) {
        $search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
        $replace = array('>', '<', '\\1');
        $bufferData = preg_replace($search, $replace, $buffer);
        return $bufferData;
    }

    public function showError($data) {
        if (!empty($data)) {
            extract($data);
        }

        if (HTMLcompress == TRUE) {
            ob_start();
            require_once coreDir . 'view/showError.php';
            $output = ob_get_contents();
            $compressData = $this->compress($output);
            ob_end_clean();
            echo $compressData;
        } else {
            require_once coreDir . 'view/showError.php';
        }
    }

    public function showView($filePath, $data = null) {
        if (!empty($data)) {
            extract($data);
        }
        if (!file_exists(viewDir . $filePath . '.php')) {
            (new error())->fileNotFound(); // shows error if the file is not found in the location.
            exit();
        }
        if (HTMLcompress == TRUE) {
            ob_start();
            require_once viewDir . $filePath . '.php';
            $output = ob_get_contents();
            $compressData = $this->compress($output);
            ob_end_clean();
            echo $compressData;
        } else {
            require_once viewDir . $filePath . '.php';
        }
    }

    public function getContents($filePath) {
        return file_get_contents(viewDir . $filePath);
    }

}
