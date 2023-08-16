<?php 

    require_once('../../private/initialize.php');
    $page_title = 'Login';
    session_start();

    if(is_post_request()){
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $password = hash('sha512', $password . $_ENV['SALT']);
        $user = check_user_signin($username);
        if($user){
            //password_verify($password, $user['pass'])
            if($user['pass'] === $password){
                $_SESSION["user_id"] = $user['user_id'];
                $_SESSION["username"] = $username;
                $_SESSION["is_logged_in"] = true;
                redirect_to(url_for('/index.php'));
            }
        }
        else{
            echo 'Incorrect username or password';
        }
    }
?>

<?php include(SHARED_PATH . '/shared_header.php'); ?>

<body>
    <h1> Login </h1>
    <form action="<?php echo h($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="" /><br />
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="" /><br />
        <input type="submit" name="submit" value="Submit"  />
        <a class="sign-up" href="<?php echo url_for('/users/new.php'); ?>">new? sign up</a>
    </form>

<?php include(SHARED_PATH . '/shared_footer.php'); ?>