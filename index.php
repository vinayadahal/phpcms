<?php

// donot edit this page at all
define('coreDir', 'core/'); // core directory location
define('configDir', 'config/'); // config directory location
define('modelDir', 'models/'); // model directory location
define('controllerDir', 'controller/'); // controller directory location
define('cssDir', 'css/'); // css directory location
define('imageDir', 'images/'); // image directory location
define('viewDir', 'view/'); // view directory location
define('jsDir', 'js/'); // javascript directory location
define('defaultPage', 'home'); // default page to load as soon as URL is requested
define('rootDir', dirname(__FILE__)); // absolute path on server to index.php

require_once coreDir . 'handler.php'; // heart of the framework's starting position

if (dbOperation == 'create') {
    require_once coreDir . 'constructor/generateAll.php'; // generates database and table if not exist
}

if (dbOperation == 'drop-create') {
    require_once coreDir . 'constructor/degenerateAll.php';
}

if (dbOperation == 'none') {
    // nothing to fill   
}