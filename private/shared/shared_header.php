<?php
    if(!isset($page_title)) { $page_title = 'VGBL'; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="all" href="<?php echo url_for('stylesheets/stylesheet.css'); ?>">
    <title>VGBL - <?php echo $page_title; ?></title>
</head>
<body>
    <header>
        <h1>The Video Game Backlog</h1>
    </header>
    <nav>
        <ul>
            <div class="leftside">
                <li><a href="<?php echo url_for('index.php'); ?>">Home</a></li>
                <li><a href="<?php echo url_for('about.php'); ?>">About</a></li>
                <li><a href="<?php echo url_for('contact.php'); ?>">Contact</a></li>
            </div>
            <div class="rightside">
                <li><a href="<?php echo url_for('users/login.php'); ?>">Login</a></li>
            </div>
        </ul>
    </nav>
    
