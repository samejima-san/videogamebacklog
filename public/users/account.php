<?php
    require_once('../../private/initialize.php');
    $id = $_GET['username'] ?? '1';
    $user = find_user_by_id($id);
    $username = $user['username'] ?? 'Anonymous';
    $page_title = 'Account ' . $id;

?>

<?php include(SHARED_PATH . '/shared_header.php'); ?>
<body>
    <h1> Account </h1>
    <p>Username: <?php echo h($username); ?></p>
    <p>First Name: <?php echo h($user['first_name']); ?></p>
    <p>Last Name: <?php echo h($user['last_name']); ?></p>
    <p>Email: <?php echo h($user['email']); ?></p>
<?php include(SHARED_PATH . '/shared_footer.php'); ?>