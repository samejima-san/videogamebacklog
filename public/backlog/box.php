<?php 
    require_once('../../private/initialize.php');
    $page_title = 'Your Backlog';
    $u = $_GET['username'] ?? ''; 
    $data = get_moby_api('games?format=brief', 'moby_3QJYFKLb7CGCMIU3A6rwP2UiTa2');
?>

<?php include(SHARED_PATH . '/shared_header.php'); ?>

<body>
    <h1>Your Backlog</h1>
    <button id="addgames">Add Games to Your Backlog?</button>
    <div id="finding-games" class="hidden" >
        <form action="<?php echo h($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="search">Search for a game:</label>
            <input type="text" id="search" name="search" value="" /><br />
            <input type="submit" name="submit" value="Submit"  />
        </form>
        <?php 
            if(is_post_request()){
                $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
                $search = str_replace(' ', '%20', $search);
                $data = get_moby_api('games?title=' . $search . '&format=brief', 'moby_3QJYFKLb7CGCMIU3A6rwP2UiTa2');
                if($data === null){
                    echo '<div id="games">';
                    echo '<p>No games found</p>';
                    echo '</div>';
                }
                else{
                    echo '<div id="games">';
                    foreach($data as $game){
                        echo '<div class="game">';
                        echo '<img src="' . $game['image'] . '" alt="' . $game['title'] . '">';
                        echo '<p>' . $game['title'] . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
            $dataArray = json_decode($data, true);

            // Check if decoding was successful
            if (is_array($dataArray) && array_key_exists('games', $dataArray)) {
                $games = $dataArray['games'];
            }
            
                // Loop through the games array
            foreach ($games as $game) {
                    $game_id = $game['game_id'];
                    $moby_url = $game['moby_url'];
                    $title = $game['title'];

                    echo "<p>Title: $title</p>";
                    echo "<p>Game No. $game_id</p>";
                    echo "<p>URL: <a href='$moby_url'>$moby_url</a></p>";
                }
        ?>
    </div>

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