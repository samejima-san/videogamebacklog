<?php

    function insert_user($user){
        global $db;

        if(!unique_username($user['username'])){
            return 'Username already exists';
        }

        if(!unique_email($user['email'])){
            return 'Email already exists';
        }

        $sql = "INSERT INTO users ";
        $sql .= "(email, username, first_name, last_name, pass) ";
        $sql .= "VALUES (";
        $sql .= "'" . $user['email'] . "',";
        $sql .= "'" . $user['username'] . "',";
        $sql .= "'" . $user['first_name'] . "',";
        $sql .= "'" . $user['last_name'] . "',";
        $sql .= "'" . $user['password'] . "'";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        if($result){
            return true;
        }else{
            echo mysqli_error($db);
            db_disconnect($db);
            return false;
        }
    }

    function unique_username($username){
        global $db;

        $sql = "SELECT username FROM users ";
        $sql .= "WHERE username='" . $username . "'";

        $result = mysqli_query($db, $sql);
        $user_count = mysqli_num_rows($result);
        mysqli_free_result($result);

        return $user_count === 0;
    }

    function unique_email($email){
        global $db;

        $sql = "SELECT email FROM users ";
        $sql .= "WHERE email='" . $email . "'";

        $result = mysqli_query($db, $sql);
        $user_count = mysqli_num_rows($result);
        mysqli_free_result($result);

        return $user_count === 0;
    }

    function find_user_by_id($id){
        global $db;

        $sql = "SELECT user_id, username FROM users ";
        $sql .= "WHERE username='" . $id . "'";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        return $user;
    }

    function check_user_signin($username){
        global $db;

        $sql = "SELECT user_id, username, pass FROM users ";
        $sql .= "WHERE username='" . $username . "'";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        return $user;
    }
?>