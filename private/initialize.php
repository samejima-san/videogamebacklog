<?php


    require_once __DIR__ . '/../vendor/autoload.php';
    use Dotenv\Dotenv;


    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("PUBLIC_PATH", PROJECT_PATH . '/public');
    define("SHARED_PATH", PRIVATE_PATH . '/shared');

    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

    require_once('functions.php');
    require_once('database.php');
    require_once('query_functions.php');
    $db = db_connect();

    try {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    if(!isset($DB_CREDS)){
        $DB_CREDS = true;
        define("DB_SERVER", $_ENV['DB_SERVER']);
        define("DB_USER", $_ENV['DB_USER']);
        define("DB_PASS", $_ENV['DB_PASS']);
        define("DB_NAME", $_ENV['DB_NAME']);
        define("SALT", $_ENV['SALT']);
        define("VGDB_CLIENT_ID", $_ENV['VGDB_CLIENT_ID']);
        define("VGDB_CLIENT_SECRET", $_ENV['VGDB_CLIENT_SECRET']);
    }
?>