<?php
    $photo_data = "data/photos.js";
    $json = json_decode(file_get_contents($photo_data), true);
    $titles = array('Pass the Prude', 'You\'re Doing it Wrong', 'What a Jerk!', 'Derp.');
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
        
        <link rel="stylesheet" href="css/slick.css">
        <link rel="stylesheet" href="css/slick-theme.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/h5bp-2.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>

    <?php
        $test = $_COOKIE["which_test"];
        $group = $_COOKIE["which_group"];
        echo '<body id="game" class="test-' . $test .'">';
    ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="content">
            <h2 class="section">
                <?php echo $titles[$test-1]; ?>
            </h2>

            <div class="section">
                <?php
                    echo '<div class="group-'.$group.'">';
                    foreach($json[photo] as $p) {
                        if($p[group] === $group) {
                            echo '
                                <div class="carousel-and-form">
                                    <div id="carousel-'.$p[id].'" class="carousel">
                                        <div class="preloader reject"><img src="resources/img/BOO.png" alt="" /></div>
                            ';
                            if ($test !== '2') {
                                echo '
                                        <div class="main-slide photo"><img src="data/photos/'.$p[src].'" id="'.$p[id].'"/></div>
                                ';
                            }
                            else {
                                echo '
                                        <div class="main-slide text">
                                            <p id="'.$p[id].'">'.$p[comment].'<br/>by <strong>'.$p[nickname].'</strong></p>
                                        </div>
                                ';
                            }
                            echo '
                                        <div class="preloader approve"><img src="resources/img/OK.png" alt="" /></div>
                                    </div>
                                    <form id="form-'.$p[id].'">
                                        <input type="hidden" name="photo-id" value="'.$p[id].'"/>
                                        <input type="hidden" name="photo-group" value="'.$p[group].'"/>
                                        <input type="hidden" name="test-id" value="'.$test.'"/>
                                        <input type="hidden" name="approved" value=""/>
                                    </form>
                                </div>
                            ';
                        }
                    }
                    echo '</div>';
                ?>
            </div>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/vendor/jquery.serializejson.js"></script>
        <?php
            // tiff TODO: Change this to slick.min.js
        ?>
        <script src="js/vendor/slick.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script>
        $(document).ready(function(){
          iniSlick('#carousel-1');
          $('.carousel').on('afterChange', function(event, slick, currentSlide) {

            // Rejected
            if (currentSlide === 0) {
                $(this).siblings('form').find('input[name="approved"]').val('false');
            }
            // Approved
            else if (currentSlide === 2) {
                $(this).siblings('form').find('input[name="approved"]').val('true');
            }
            var carouselIdStr = $(this).attr('id');
            var carouselIdInt = parseInt(carouselIdStr.substring(carouselIdStr.length - 1));
            console.log(currentSlide + ', ' + carouselIdInt);
            // Update moderation status
            var formIdStr = '#form-' + carouselIdInt;
            var jsonText = JSON.stringify($(formIdStr).serializeJSON());
            console.log(jsonText);
            var json = {'data': jsonText};
            
            $.ajax({
                url: "writejson.php",
                type: "POST",
                data: json
            });

            // Hide last photo carousel, show next photo carousel
            if (carouselIdInt < 5) {
                
                


                var preloader = function() {
                    $('#carousel-' + carouselIdInt).hide();
                    iniSlick('#carousel-' + (carouselIdInt + 1));
                    clearTimeout(muffin);
                }

                var muffin = setTimeout(preloader, 1000);


            }
            else {
                document.location = 'thanks.php';
            }

          });

            function iniSlick(carousel){
                $(carousel).show();
                $(carousel).slick({
                    initialSlide: 1
                }); 

                // make the approve / reject slides the same height
                $(carousel).find('.preloader').height(  $(carousel).find('.main-slide').height()  );
            }
        });
        </script>

    </body>
</html>
