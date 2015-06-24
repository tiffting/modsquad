<?php 
    parse_str($_SERVER['QUERY_STRING']);
    // Hardcode the starting test if no test is specified in the URL
    if (!isset($test)) {
        $test = '1';
    }
    setcookie('which_test', $test);
    // If no previous photo group done, start with photo group a
    $groupsDone = $_COOKIE['groups_done'];
    if (!isset($groupsDone)) {
        setcookie('which_group', 'a');
    }
    else {
        $length = strlen($groupsDone);
        $lastChar = substr($groupsDone, ($length - 1));
        $currentGroup = substr($groupsDone, (strlen($groupsDone) - 1));
        setcookie('which_group', ++$currentGroup);
    }
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Let's play a game!</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/h5bp-1.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/h5bp-2.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <?php 
        echo '<body id="home" class="test-' . $test .'">';    
    ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="test-1" class="content">
            <h1 class="section title">
                Pass the Prude
            </h1>            
            <div class="section instruction left">
                <p>
                    <strong>Swipe LEFT</strong> if the photo would <strong>make Ned Flanders uncomfortable</strong>:
                </p>
                <ul>
                    <li>It has violence, nudity, or other R-rated stuff, or</li>
                    <li>It's mean-spirited</li>
                </ul>
            </div>
            <div class="section instruction right">
                <p>
                    Otherwise, <strong>Swipe RIGHT</strong>!
                </p>
            </div>

            <p class="action">
                <a href="game.php">Start</a>
            </p>
        </div>

        <div id="test-2" class="content">
            <h1 class="section title">
                You're Doing it Wrong
            </h1>            
            <div class="section instruction left">
                <p>
                    <strong>Swipe LEFT</strong> if the caption or nickname <strong>didn't get the assignment</strong>:
                </p>
                <ul>
                    <li>It's not in English (this is 'merica!),</li>
                    <li>It has PII (like someone's phone number), or </li>
                    <li>It's spam</li>
                </ul>
            </div>
            <div class="section instruction right">
                <p>
                    Otherwise, <strong>Swipe RIGHT</strong>!
                </p>
            </div>

            <p class="action">
                <a href="game.php">Start</a>
            </p>
        </div>

        <div id="test-3" class="content">
            <h1 class="section title">
                What a jerk!
            </h1>            
            <div class="section instruction left">
                <p>
                    <strong>Swipe LEFT</strong> if the photo <strong>was taken by a jerk</strong>:
                </p>
                <ul>
                    <li>It has obscene gestures or whatever, or</li>
                    <li>It could get YETI in trouble</li>
                </ul>
            </div>
            <div class="section instruction right">
                <p>
                    Otherwise, <strong>Swipe RIGHT</strong>!
                </p>
            </div>

            <p class="action">
                <a href="game.php">Start</a>
            </p>
        </div>

        <div id="test-4" class="content">
            <h1 class="section title">
                Derp.
            </h1>            
            <div class="section instruction left">
                <p>
                    <strong>Swipe LEFT</strong> if the photo <strong>is missing a YETI product</strong>.
                </p>
            </div>
            <div class="section instruction right">
                <p>
                    Otherwise, <strong>Swipe RIGHT</strong>!
                </p>
            </div>

            <p class="action">
                <a href="game.php">Start</a>
            </p>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
