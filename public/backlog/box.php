<?php 
    require_once('../../private/initialize.php');
    $page_title = 'Your Backlog';
    session_start();
    $u = $_GET['username'] ?? '';
?>

<?php include(SHARED_PATH . '/shared_header.php'); ?>

<body>
    <h1>Your Backlog</h1>

<?php include(SHARED_PATH . '/shared_footer.php'); ?>