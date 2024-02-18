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

    function check_user_signin($username) {
        global $db;
    
        // Check the connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    
        $sql = "SELECT user_id, username, pass FROM users ";
        $sql .= "WHERE username='" . $username . "'";
    
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        
        // Close the database connection
        mysqli_close($db);
    
        return $user;
    }

    function check_user_box_exist($user_id){
        global $db;

        $sql = "SELECT * FROM box ";
        $sql .= "WHERE user_id='" . $user_id . "'";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $box = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        return $box;//returns null if no box exists
    }

    function create_box($user_id){
        global $db;
        $sql = "INSERT INTO box ";
        $sql .= "(user_id) ";
        $sql .= "VALUES (";
        $sql .= "'" . $user_id . "'";
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
    
    function get_box_id($user_id){
        global $db;
        $sql = "SELECT box_id FROM box ";
        $sql .= "WHERE user_id='" . $user_id . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $box = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $box;
    }

    function add_game_to_box($game_id, $box_id){
        global $db;
        $sql = "INSERT INTO game_box ";
        $sql .= "(game_id, box_id) ";
        $sql .= "VALUES (";
        $sql .= "'" . $game_id . "',";
        $sql .= "'" . $box_id . "'";
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

    function get_all_games_from_box($user_id){
        global $db;

       //get box_id from box table
       //get all games from box_games table where box_id = box_id
        //get all game info from games table where game_id = game_id
        $sql = "SELECT box_id FROM box ";
        $sql .= "WHERE user_id='" . $user_id . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $box = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
       
        $sql = "SELECT game_id FROM game_box ";
        $sql .= "WHERE box_id='" . $box['box_id'] . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $game = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        /*$sql = "SELECT * FROM games ";
        $sql .= "WHERE game_id='" . $game['game_id'] . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);*/
        return $game;
    }

    function get_moby_api($endpoint, $apiKey){
        $baseUrl = 'https://api.mobygames.com/v1/';
        $url = $baseUrl . $endpoint . '&api_key=' . $apiKey;
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        // Process the response
        if ($data) {
            return json_encode($data);
        } else {
            // Handle API errors or empty response
            return "Failed to retrieve game information.\n";
        }
    }
    
?>