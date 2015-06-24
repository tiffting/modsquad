<?php 
    $currentTest = $_COOKIE["which_test"];
    $testsDone = $_COOKIE["tests_done"];
    $nextTest = ($currentTest % 4) + 1;
    $allDone = false;
    // Update list of tests done
    if (!isset($testsDone)) {
        setcookie('tests_done', $currentTest);
    }
    else {
        setcookie('tests_done', $testsDone.','.$currentTest);
    }
    $testsDone = $_COOKIE["tests_done"];
    // Show another test, or go to the end?
    if (strlen($testsDone) < 5) {
        setcookie('which_test', $nextTest);
    }
    else {
        $allDone = true;
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
        echo '<body id="thanks" class="test-' . $currentTest .'">';
    ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="test-1" class="content">
            <h1 class="section title">
                Pass the Prude
            </h1>            
            <div class="section report">
                <p>
                    Great job! [Graph goes here]
                </p>
            </div>

            <p class="action">
                <?php
                    if ($allDone == true) {
                        echo '<a>Thanks so much!</a>';
                    }
                    else {
                        echo '<a href="home.php?test='.$nextTest.'">Next</a>';
                    }
                ?>
            </p>
        </div>

        <div id="test-2" class="content">
            <h1 class="section title">
                You're Doing it Wrong
            </h1>            
            <div class="section report">
                <p>
                    Great job! [Graph goes here]
                </p>
            </div>

            <p class="action">
                <?php
                    if ($allDone == true) {
                        echo '<a>Thanks so much!</a>';
                    }
                    else {
                        echo '<a href="home.php?test='.$nextTest.'">Next</a>';
                    }
                ?>
            </p>
        </div>

        <div id="test-3" class="content">
            <h1 class="section title">
                What a jerk!
            </h1>            
            <div class="section report">
                <p>
                    Great job! [Graph goes here]
                </p>
            </div>

            <p class="action">
                <?php
                    if ($allDone == true) {
                        echo '<a>Thanks so much!</a>';
                    }
                    else {
                        echo '<a href="home.php?test='.$nextTest.'">Next</a>';
                    }
                ?>
            </p>
        </div>

        <div id="test-4" class="content">
            <h1 class="section title">
                Derp.
            </h1>            
            <div class="section report">
                <p>
                    Great job! [Graph goes here]
                </p>
            </div>

            <p class="action">
                <?php
                    if ($allDone == true) {
                        echo '<a>Thanks so much!</a>';
                    }
                    else {
                        echo '<a href="home.php?test='.$nextTest.'">Next</a>';
                    }
                ?>
            </p>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
