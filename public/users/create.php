<?php
require_once('../../private/initialize.php');

//if password is not equal to confirmpassword then redirect to new.php


if(is_post_request()){
    $user = [];
    $user['email'] = $_POST['email'] ?? '';
    $user['username'] = $_POST['username'] ?? '';
    $user['first_name'] = $_POST['first_name'] ?? '';
    $user['last_name'] = $_POST['last_name'] ?? '';
    $user['password'] = $_POST['password'] ?? '';
    $user['confirm_password'] = $_POST['confirm_password'] ?? '';

    if($user['password'] !== $user['confirm_password']){
        redirect_to(url_for('/users/new.php'));
    }

    $result = insert_user($user);
    if($result === true){
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/users/show.php?id=' . $new_id));
    }else{
        $errors = $result;
    }
}

?>