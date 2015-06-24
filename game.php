<?php
    $photo_data = "data/photos.js";
    $json = json_decode(file_get_contents($photo_data), true);
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
        <link rel="stylesheet" href="css/slick.css">
        <link rel="stylesheet" href="css/slick-theme.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/h5bp-2.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <?php
        $startTest = $_COOKIE["which_test"];
        echo '<body id="game" class="test-' . $startTest .'">';
    ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="content">
            <?php
                echo '<div class="group-a">';
                foreach($json[photo] as $p) {
                    if($p[group] == 'a') {
                        echo '
                            <div id="carousel-'.$p[id].'" class="carousel">
                                <div>reject</div>
                                <div class="photo"><img src="data/photos/'.$p[src].'" id="'.$p[id].'"/></div>
                                <div>approve</div>
                            </div>
                        ';
                    }
                }
                echo '</div>';
            ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <?php
            // tiff TODO: Change this to slick.min.js
        ?>
        <script src="js/vendor/slick.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script>
        $(document).ready(function(){
          $('.carousel').slick({
            initialSlide: 1
          });
          // Show first carousel
          $('#carousel-1').show();
          $('.carousel').on('swipe', function(event, slick, direction) {
            if (direction === 'left') {
                // TODO: write a rejection
                console.log(direction);
            }
            else if (direction === 'right') {
                // TODO: write an approval
                console.log(direction);
            }
            var carouselIdStr = $(this).attr('id');
            var carouselIdInt = parseInt(carouselIdStr.substring(carouselIdStr.length - 1));
            console.log(carouselIdInt);
            if (carouselIdInt < 5) {
                $('#carousel-' + carouselIdInt).hide();
                $('#carousel-' + (carouselIdInt + 1)).show();
            }
            else {
                // TODO: show thank you page
                document.location = 'thanks.php';
            }
          });
        });
        </script>

    </body>
</html>
