<?php

// This file takes information about the database.

define('host', $_SERVER['HTTP_HOST']); // Your hostname(if possible adding IP address will make it faster).

define('username', 'root'); // Your username.

define('password', ''); // Your password.

define('database', 'cms'); // Your database name.

define('dbOperation', 'none'); // Choose between none, create, drop-create

define('setPersistence', FALSE); // Setting true makes database connection faster
