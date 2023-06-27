<?php
    require_once('../../private/initialize.php');
    $page_title = 'Sign Up';
    session_start();
    if(is_post_request()){
        $user = [];

        $user['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $user['username'] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $user['first_name'] = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
        $user['last_name'] = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $user['password'] = hash('sha512', $password . $_ENV['SALT']);
        $cpassword = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);
        $user['confirm_password'] = hash('sha512', $cpassword . $_ENV['SALT']);

        if(empty($user['email']) || empty($user['username']) || empty($user['first_name']) || empty($user['last_name']) || empty($user['password']) || empty($user['confirm_password'])){
            $error_message = 'Please fill in all fields';
        }

        if($user['password'] !== $user['confirm_password']){
            $error_message = 'Passwords do not match';
        }

        $result = insert_user($user);
        if($result === true){
            $new_id = mysqli_insert_id($db);
            $_SESSION['user_id'] = $new_id;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['is_logged_in'] = true;
            redirect_to(url_for('/index.php'));
        }else {
            $error_message = $result;
        }
    }
?>

<?php include(SHARED_PATH . '/shared_header.php'); ?>

<body>
    <h1> Sign Up </h1>
    <form action="<?php echo h($_SERVER["PHP_SELF"]);?>" method="post">
        <?php if (isset($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email"><br />
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

<?php include(SHARED_PATH . '/shared_footer.php'); ?>