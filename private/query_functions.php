<?php
    function insert_user($user){
        global $db;

        $errors = validate_user($user);
        if(!empty($errors)){
            return $errors;
        }
        //yedagoat is a salt
        $hashed_password = password_hash($user['password'] . "yedagoat", PASSWORD_BCRYPT);

        $sql = "INSERT INTO users ";
        $sql .= "(email, username, first_name, last_name, hashed_password) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $user['email']) . "',";
        $sql .= "'" . db_escape($db, $user['username']) . "',";
        $sql .= "'" . db_escape($db, $user['first_name']) . "',";
        $sql .= "'" . db_escape($db, $user['last_name']) . "',";
        $sql .= "'" . db_escape($db, $hashed_password) . "'";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        if($result){
            return true;
        }else{
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }
?>