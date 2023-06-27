<?php 

require_once('../../private/initialize.php');
$page_title = 'Logging out';

?>

<?php include(SHARED_PATH . '/shared_header.php'); ?>

<?php 
function logout(){
    unset($_SESSION['username']);
    unset($_SESSION['user_id']);
    $_SESSION['is_logged_in'] = false;
    sleep(.5);
    redirect_to(url_for('/index.php'));
}
?>
<body>
    <h1> Logging out </h1>
    <p> You have been logged out </p>

<?php include(SHARED_PATH . '/shared_footer.php'); ?>

<?php logout(); ?>