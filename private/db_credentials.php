<?php
require_once('initialize.php');

define("DB_SERVER", getenv('DB_SERVER'));
define("DB_USER", getenv('DB_USER'));
define("DB_PASS", getenv('DB_PASS'));
define("DB_NAME", getenv('DB_NAME'));
define("SALT", getenv('SALT'));
define("VGDB_CLIENT_ID", getenv('VGDB_CLIENT_ID'));
define("VGDB_CLIENT_SECRET", getenv('VGDB_CLIENT_SECRET'));

/*
define("DB_SERVER", "localhost");
define("DB_USER", "saint");
define("DB_PASS", "karatekidv2");
define("DB_NAME", "users");
*/


?>