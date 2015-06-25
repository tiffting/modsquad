
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Moderation Results</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/h5bp-1.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/h5bp-2.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <body style="padding: 0;">
        
        <div class="results">

            <div class="section">
               <ol class="tally">
                    <li>
                        <small>Rejected</small>
                        <h2 class="rejected">2</h2>                       
                    </li>
                    <li>
                        <small>Approved</small>
                        <h2 class="approved">4</h2> 
                    </li>
               </ol>
            </div>

            <!-- Insert templates here via JS -->

        </div>

        <div id="photo-template">
            <div class="section clearfix">
                <div class="col col-narrow">
                    <div class="inside">
                        <figure>
                            <img src="" alt="" />
                            <figcaption>
                                <p>
                                    <span class="comment">SOMETHING_COMMENTY</span>
                                </p>
                                <p>
                                    <strong>By:</strong> <span class="nickname">SOMETHING_NICKNAMEY</span>
                                </p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col col-wide">
                    <div class="inside">
                        <h2 class="SOMETHING_STATUSY">SOMETHING_STATUSY</h2>
                        <ol>
                            <li class="bar SOMETHING_STATUSY">
                                <div></div>
                                <div class="percentage" style="width: SOMETHING_PERCENT_APPROVEDY"></div>                            
                            </li>
                            <li class="bar SOMETHING_STATUSY">
                                <div></div>
                                <div class="percentage" style="width: SOMETHING_PERCENT_APPROVEDY"></div>                            
                            </li>
                            <li class="bar SOMETHING_STATUSY">
                                <div></div>
                                <div class="percentage" style="width: SOMETHING_PERCENT_APPROVEDY"></div>                            
                            </li>
                            <li class="bar SOMETHING_STATUSY">
                                <div></div>
                                <div class="percentage" style="width: SOMETHING_PERCENT_APPROVEDY"></div>                            
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/vendor/underscore-min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(document).ready(function(){
                $.ajax({
                    method: 'GET',
                    url: 'data/modResponses.js',
                    dataType: 'text',
                    success: function(responsesRaw) {
                        generateReport(responsesRaw);
                    }
                });
            });
            var generateReport = function(body) {
                // Variablize DOM elements
                var $results = $('.results');
                var $photoTemplate = $('#photo-template').children();
                // Create JSON object from modResponses.js with valid JSON wrapper
                var reTrailingComma = /,$/;
                var validBody = body.replace(reTrailingComma, '');
                var contentStr = '{\n\t\"responses\": [' + validBody + '\n\t]\n}';
                var contentJson = JSON.parse(contentStr);
                var responses = contentJson.responses;
                // Aggregate approval per photoId+testId(current) combo
                    // e.g., photoId: 21, testId: 3
                    // totalResponses: 100, approvedCount: 75
                var responsesByPhoto = _.groupBy(responses, 'photoId');
                var responsesByPhotoArray = _.map(responsesByPhoto);
                var photoCount = _.keys(responsesByPhoto).length;
                var totalResponsesByPhoto = new Array(photoCount);
                var approvedResponsesByPhoto = new Array(photoCount);
                // Create multidimensional part to store results per test
                var totalTests = 4;
                for (var i = 0; i < photoCount; i++) {
                    totalResponsesByPhoto[i] = [' ', ' ', ' ', ' '];
                    approvedResponsesByPhoto[i] = [' ', ' ', ' ', ' '];
                    $results.append($photoTemplate).html();
                    var $thisPhoto = $results.find('.section.clearfix').eq(i);
                    $thisPhoto.find('img').attr('src', 'data/photos/photo-' + responsesByPhotoArray[0][0].photoId + '.jpg');
                    // TODO: need to read photos.js for the comment and nickname, ideally for the photo src, too (above).
                    // $thisPhoto.find('.comment').
                    // debugger
                    var testResponses = _.map(_.groupBy(responsesByPhotoArray[i], 'testId'));
                    for (var j = 0; j < testResponses.length; j++) {
                        // Total responses = length of testResponses[j]
                        totalResponsesByPhoto[i][j] = testResponses[j].length;
                        // Approved responses = ???
                        var yesOrNo = _.countBy(testResponses[j], function(obj) {
                            return obj['approved'] === 'true' ? 'approved' : 'rejected'
                        });
                        if (yesOrNo['approved'] !== undefined) {
                            approvedResponsesByPhoto[i][j] = yesOrNo['approved'];                        
                        }
                        else {
                            approvedResponsesByPhoto[i][j] = 0;
                        }
                    }
                }
                console.log('approved responses');
                console.log(approvedResponsesByPhoto);
                console.log('==================');
                console.log('total responses');
                console.log(totalResponsesByPhoto);
            };
        </script>
    </body>
</html>
