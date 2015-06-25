<?php
    $currentTest = $_COOKIE['which_test'];
    $testsDone = $_COOKIE['tests_done'];
    $currentGroup = $_COOKIE['which_group'];
    $groupsDone = $_COOKIE['groups_done'];
    $totalTests = 4; // should match the number of tests
    $nextTest = ($currentTest % $totalTests) + 1;
    $allDone = false;
    // Update list of tests done
    if (!isset($testsDone)) {
        setcookie('tests_done', $currentTest);
    }
    else {
        setcookie('tests_done', $testsDone.','.$currentTest);
    }
    // Update list of groups done
    if (!isset($groupsDone)) {
        setcookie('groups_done', $currentGroup);
    }
    else {
        setcookie('groups_done', $groupsDone.','.$currentGroup);
    }
    // Show another test, or go to the end?
    $maxLenTestsDone = (($totalTests - 1) * 2) - 1;
    if (strlen($testsDone) < $maxLenTestsDone) {
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
                <p id="#score" class="score">
                    You scored <br />
                    <strong class="number">82</strong><br />
                    <span class="number">82</span>% of peeps voted like you did.                           
                </p>
            </div>

            <p class="action">
                <?php
                    if ($allDone === TRUE) {
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
                <p id="#score" class="score">
                    You scored <br />
                    <strong class="number">82</strong><br />
                    <span class="number">82</span>% of peeps voted like you did.                           
                </p>
            </div>

            <p class="action">
                <?php
                    if ($allDone === TRUE) {
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
                <p id="#score" class="score">
                    You scored <br />
                    <strong class="number">82</strong><br />
                    <span class="number">82</span>% of peeps voted like you did.                           
                </p>
            </div>

            <p class="action">
                <?php
                    if ($allDone === TRUE) {
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
                <p id="#score" class="score">
                    You scored <br />
                    <strong class="number">82</strong><br />
                    <span class="number">82</span>% of peeps voted like you did.                           
                </p>
            </div>

            <p class="action">
                <?php
                    if ($allDone === TRUE) {
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
        <?php
            if ($allDone) {
                echo "
                    <script type='text/javascript' src='js/vendor/jquery.fireworks.js'></script>
                    <script>
                        $('body').fireworks();
                    </script>
                ";
            }
        ?>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <script>
            $(document).ready(function(){
                
                $('.score').each(function(){
                    var number = Math.floor( Math.random() * (100 - 50) + 50 );
                    $(this).find('.number').text(number);
                });

            });
        </script>

    </body>
</html>
