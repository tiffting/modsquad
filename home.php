<?php 
    parse_str($_SERVER['QUERY_STRING']);
    // Hardcode the starting test if no test is specified in the URL
    if (!isset($test)) {
        $test = '1';
    }
    setcookie('which_test', $test);
    // If no previous photo group done, start with photo group a
    $groupsDone = $_COOKIE['groups_done'];
    $group = $_COOKIE["which_group"];
    if (!isset($groupsDone) || $group == '4') {
        setcookie('which_group', '1');
        setcookie('groups_done', '');
        setcookie('tests_done', '');
    }
    else {
        $currentGroup = substr($groupsDone, -1);
        setcookie('which_group', ++$currentGroup);
    }

    include 'instructions.php';
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Let's play!</title>
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
                <?php echo $titles[$test-1]; ?>
            </h1> 

            <?php echo $left[0] ?>

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
                <?php echo $titles[$test-1]; ?>
            </h1> 

            <?php echo $left[1] ?>

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
                <?php echo $titles[$test-1]; ?>
            </h1> 

            <?php echo $left[2] ?>

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
                <?php echo $titles[$test-1]; ?>
            </h1>    

            <?php echo $left[3] ?>

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
