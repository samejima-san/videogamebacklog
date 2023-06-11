<?php 

    require_once('../../private/initialize.php');
    $page_title = 'Login';
?>


<?php include(SHARED_PATH . '/shared_header.php'); ?>

<body>
    <h1> Login </h1>
    <form action="<?php echo url_for('/users/loginuser.php');?>" method="get">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="" /><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="" /><br />
        <input type="submit" name="submit" value="Submit"  />
        <a class="sign-up" href="<?php echo url_for('/users/new.php'); ?>">new? sign up</a>
    </form>

<?php include(SHARED_PATH . '/shared_footer.php'); ?>