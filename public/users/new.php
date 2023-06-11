<?php
    require_once('../../private/initialize.php');
    $page_title = 'Sign Up';
?>

<?php include(SHARED_PATH . '/shared_header.php'); ?>

<body>
    <h1> Sign Up </h1>
    <form action="<?php echo url_for('/users/create.php');?>" method="post">
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="" /><br />
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="" /><br />
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="" /><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="" /><br />
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" value="" /><br />
        <input type="submit" name="submit" value="Submit"  />
    </form>

    <script src="signup.js"></script>


<?php include(SHARED_PATH . '/shared_footer.php'); ?>