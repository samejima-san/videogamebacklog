<?php 
    require_once('../../private/initialize.php');
    $page_title = 'Your Backlog';
    $u = $_GET['username'] ?? ''; 
    $data = get_moby_api('games?format=brief', 'moby_3QJYFKLb7CGCMIU3A6rwP2UiTa2');
    $data = json_decode($data, true);


    if(is_post_request()){
        $game_title = filter_input(INPUT_POST, 'game_title', FILTER_SANITIZE_STRING);
        $game_id = filter_input(INPUT_POST, 'game_id', FILTER_SANITIZE_STRING);
        add_game_to_box($_SESSION['box_id'], $game_id, $game_title);
        redirect_to(url_for('backlog/box.php'));
    }
?>

<?php include(SHARED_PATH . '/shared_header.php'); ?>

<body>
    <h1>Your Backlog</h1>
    <button id="addgames">Add Games to Your Backlog?</button>

    <?php 
        //check if user has a box
        //if not, create one
        //if so, display it
        //if user is not logged in, redirect to login page
        if(!isset($_SESSION['is_logged_in'])){
            $_SESSION['is_logged_in'] = false;
            redirect_to(url_for('users/login.php'));
        }
        if(check_user_box_exist($_SESSION['user_id']) !== null){
            $games = get_all_games_from_box($_SESSION['user_id']);
            //if null, echo "no games in box"
            if($games === null){
                echo '<div class="games">';
                echo '<p>No games in box</p>';
                echo '</div>';
                echo '<div class="finding-games">';
                for ($i = 0; $i < count($data['games']); $i++) {
                    echo '<div class="games-add">';
                    echo '<p id="game_title">' . $data['games'][$i]['title'] . '</p>';
                    echo '<p id="game_id">' . $data['games'][$i]['game_id'] . '</p>';
                    echo '<form method="post" action="' . h($_SERVER["PHP_SELF"]) . '">';
                    echo '<input type="hidden" name="game_title" value="' . $data['games'][$i]['title'] . '">';
                    echo '<input type="hidden" name="game_id" value="' . $data['games'][$i]['game_id'] . '">';
                    echo '<input type="submit" value="Add to Backlog">';
                    echo '</form>';
                    echo '</div>';
                }
                
                echo '</div>';
            }
            else{
                //if not null, display games
                echo '<div class="games">';
                foreach($games as $game){
                    echo '<div class="game">';
                    echo '<img src="' . $game['image'] . '" alt="' . $game['title'] . '">';
                    echo '<p>' . $game['title'] . '</p>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }
        else{
            create_box($_SESSION['user_id']);
            $_SESSION['box_id'] = get_box_id($_SESSION['user_id']);
            echo 'created backlog, load page again to add things to your backlog';
        }
    ?>





<?php include(SHARED_PATH . '/shared_footer.php'); ?>
<script>
    //toggle div with the class finding-games on button click
    document.getElementById('addgames').addEventListener('click', function(){
        document.querySelector('.finding-games').classList.toggle('hidden');
        document.querySelector('.games').classList.toggle('hidden');
    });

</script>