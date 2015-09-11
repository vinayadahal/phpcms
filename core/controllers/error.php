<?php

class error {

    public function noController($ctrlName) {
        $errCode = 'Controller not found';
        $errMsg = 'The controller <b>' . $ctrlName . '</b> cannot be found. Please define a controller class with that name in <b>controller</b> directory.';
        $this->callError($errCode, $errMsg);
    }

    public function noModelError() {
        $errCode = 'Model not found';
        $errMsg = 'Model you specified cannot be found.';
        $this->callError($errCode, $errMsg);
    }

    public function noMethodError() {
        $errCode = 'Method not found';
        $errMsg = 'Method you specified cannot be found.';
        $this->callError($errCode, $errMsg);
    }
    
    public function insertQueryError() {
        $errCode = 'Error executing query';
        $errMsg = 'Cannot re-insert duplicate entry.';
        $this->callError($errCode, $errMsg);
    }

    public function fatalError() {
        $errCode = 'Fatal Error';
        $errMsg = 'A fatal error occurred. Please contact your system administrator.';
        $this->callError($errCode, $errMsg);
    }

    public function queryError($distinct = NULL, $filename = NULL, $line = NULL) {
        if ($distinct == NULL || $filename == NULL || $line == NULL) {
            $this->fatalError();
        } else {
            $errCode = 'Query Error';
            $errMsg = '<b>' . $distinct . '</b> is not part of a query. Please double check alphabets in <b>' . $filename . ' line number: ' . $line . '</b> and try again.';
            $this->callError($errCode, $errMsg);
        }
    }

    public function moreMethod() {
        if (environment == 'development') {
            $errCode = 'Too many method';
            $errMsg = 'Number of methods in <b>model</b> should be only one.';
            $this->callError($errCode, $errMsg);
        } else {
            $this->fatalError();
        }
    }

    public function noHost($ex) {
        if (environment == 'development') {
            $errCode = $ex . ' - Unknown Host';
            $errMsg = 'Please give correct hostname or contact your system administrator for more details.';
            $this->callError($errCode, $errMsg);
        } else {
            $this->fatalError();
        }
    }

    public function noAccess($ex) {
        if (environment == 'development') {
            $errCode = $ex . ' - Access Denied';
            $errMsg = 'Please check your username and password. Contact your system administrator for more information.';
            $this->callError($errCode, $errMsg);
        } else {
            $this->fatalError();
        }
    }

    public function noDatabase($ex) {
        if (environment == 'development') {
            $errCode = $ex . ' - Database Exception';
            $errMsg = 'Database or View not found. Please check and correct the database name or contact your system administrator.';
            $this->callError($errCode, $errMsg);
        } else {
            $this->fatalError();
        }
    }

    public function fileNotFound() {
        $errCode = '404 - Page Not Found';
        $errMsg = 'Unable to find the page you are looking for. The page does not exist on this server.';
        $this->callError($errCode, $errMsg);
    }

    public function codingError($requestFile) {
        if (environment == 'development') {
            $errCode = 'Syntax Error';
            $errMsg = 'A syntax error has occurred. Please check in the "path" file with index "' . $requestFile . '" for more details.';
            $this->callError($errCode, $errMsg);
        } else {
            $this->fatalError();
        }
    }

    public function callError($errCode, $errMsg) {
        (new loader())->showError(array('errCode' => $errCode, 'errMsg' => $errMsg));
    }

}
