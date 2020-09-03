<?php
// SITE NAME
defined('WEB_SITE_NAME')         ? null : define('WEB_SITE_NAME', 'https://login-system-2.herokuapp.com/');

// DIRECTORY SEPARATOR FOR SERVER AND BROWSER
defined('DS')                    ? null :define('DS', DIRECTORY_SEPARATOR);// the [ / ] sambol
// PROJECT FOLDERS PATH
defined('APP_PATH')              ? null :define('APP_PATH', realpath(dirname(dirname(__FILE__)))); //app folder path
defined('CONTROLLER_PATH')       ? null :define('CONTROLLER_PATH', APP_PATH.DS.'controllers'.DS);//controller folder path
defined('VIEWS_PATH')            ? null :define('VIEWS_PATH', APP_PATH.DS.'views');//view folder path
defined('TEMPLATE_PATH')         ? null :define('TEMPLATE_PATH', APP_PATH.DS.'template'.DS);// template folder path
defined('LANGUAGE_PATH')         ? null :define('LANGUAGE_PATH', APP_PATH.DS.'languages'.DS);// language folder path
defined('APP_DEFAULT_LANGUAGE')  ? null :define('APP_DEFAULT_LANGUAGE', 'ar');// language folder path

// WEBSITE ROUTE
defined('JS')                    ? null :define('JS',WEB_SITE_NAME.'/js/');//javascript folder path
defined('CSS')                   ? null :define('CSS',WEB_SITE_NAME. '/css/');//css folder path




// CONNECTION CONSTANT
defined('DATABASE_HOST_NAME')    ? null : define('DATABASE_HOST_NAME', 'localhost');
defined('DATABASE_DB_NAME')      ? null : define('DATABASE_DB_NAME', 'shfretak');
defined('DATABASE_USER_NAME')    ? null : define('DATABASE_USER_NAME', 'melad');
defined('DATABASE_PASSWORD')     ? null : define('DATABASE_PASSWORD', 'adv511998');
defined('DATABASE_CONN_DRIVER')  ? null : define('DATABASE_CONN_DRIVER', '1');
// SESSION HANDER
defined('SESSION_PATH') ? null : define('SESSION_PATH', APP_PATH .DS.'..'.DS.'session');
// APP SALT
defined('APP_SALT')     ? null : define('APP_SALT', '$2a$07$4frtkmwo83fzy3gdywsty0$');
// LANGUAGE COOKIE

// UPLOAD STORAGE HANDLER
defined('UPLOAD_PATH')           ? null : define('UPLOAD_PATH', APP_PATH .DS.'..'.DS.'upload');
defined('IMAGES_UPLOAD_PATH')    ? null : define('IMAGES_UPLOAD_PATH', UPLOAD_PATH.DS.'image'.DS);
defined('DOCUMENTS_UPLOAD_PATH') ? null : define('DOCUMENTS_UPLOAD_PATH', UPLOAD_PATH.DS.'documents'.DS);
defined('MAX_FILE_SIZE_ALLOWED') ? null : define ('MAX_FILE_SIZE_ALLOWED',  ini_get('upload_max_filesize'));

