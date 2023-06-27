<?php 
require_once('../private/initialize.php');

$page_title = 'Home';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php 
    include(SHARED_PATH . '/shared_header.php'); 
    if(!isset($_SESSION['is_logged_in'])){
        $_SESSION['is_logged_in'] = false;
    }
?>
<body>
    <h1> Home </h1>
    <?php if($_SESSION['is_logged_in']){ ?>
    <p>Welcome <?php echo $_SESSION['username']; ?></p>
    <?php }else{ ?>
        <p>Welcome Guest</p>
    <?php } ?>

<?php include(SHARED_PATH . '/shared_footer.php'); ?>