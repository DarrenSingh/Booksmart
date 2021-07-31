<?php
//Define Database Connection Constants
define('DB_HOST',getenv('DB_HOST'));
define('DB_USER',getenv('DB_USER'));
define('DB_PASS',getenv('DB_PASS'));
define('DB_NAME',getenv('DB_NAME'));

ini_set('error_log','log/error.log'); //set error log file destination
ini_set('date.timezone','America/Vancouver'); //set timezone

define( 'API_URL', 'https://www.googleapis.com/books/v1/volumes?q=' );
define( 'API_KEY', getenv('API_KEY') );

?>
