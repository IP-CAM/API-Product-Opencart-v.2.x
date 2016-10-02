<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 14.09.2016
 * Time: 13:35
 */

define('PATH_TO_ROOT_OPENCART_SCRIPT', '/vagrant/web/');

// if set IS_USE_MY_DB_SETTINGS script will get db setting here,
// if no set, settings will import from opencart confing.php file
define('IS_USE_MY_DB_SETTINGS', 1);
define('MY_DB_HOSTNAME', 'localhost');
define('MY_DB_USERNAME', 'root');
define('MY_DB_PASSWORD', 'mysqlroot');
define('MY_DB_DATABASE', 'animeopt');
define('DB_PREFIX', 'oc_');
