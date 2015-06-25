
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
                        <h2 class="rejected"></h2>                       
                    </li>
                    <li>
                        <small>Approved</small>
                        <h2 class="approved"></h2> 
                    </li>
               </ol>
            </div>

            <!-- Insert templates here via JS -->

        </div>

        <div id="photo-template" class="template">
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
                        <h2>SOMETHING_STATUSY</h2>
                        <ol>
                            <!-- Where approval rating graphs go -->
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div id="graph-template" class="template">
            <li class="bar">
                <div></div>
                <div class="percentage"></div>                            
            </li>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/vendor/underscore-min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(document).ready(function(){
                $.when(getResponses(), getPhotos()).then(function(responsesAjax, photosAjax) {
                    var responsesJson = validizeIntoJson(responsesAjax[0]);
                    generateReport(responsesJson, photosAjax[0]);
                })
            });
            var getResponses = function() {
                return $.ajax({
                    method: 'GET',
                    url: 'data/modResponses.js',
                    dataType: 'text',
                });
            };
            var validizeIntoJson = function(str) {
                // Create JSON object from modResponses.js with valid JSON wrapper
                var reTrailingComma = /,$/;
                var validBody = str.replace(reTrailingComma, '');
                var contentStr = '{\n\t\"response\": [' + validBody + '\n\t]\n}';
                var contentJson = JSON.parse(contentStr);
                return contentJson;
            }
            var getPhotos = function() {
                return $.getJSON('data/photos.js');
            };
            var generateReport = function(responses, photos) {
                // Variablize DOM elements
                var $results = $('.results');
                var photoTemplate = $('#photo-template').html();
                var graphTemplate = $('#graph-template').html();
                // Initialize approved and rejected counters
                var approvedCount = 0;
                var rejectedCount = 0;
                // Aggregate approval per photoId+testId(current) combo
                    // e.g., photoId: 21, testId: 3
                    // totalResponses: 100, approvedCount: 75
                var responsesByPhoto = _.groupBy(responses.response, 'photoId');
                var responsesByPhotoArray = _.map(responsesByPhoto);
                var photoCount = _.keys(responsesByPhoto).length;
                var totalResponsesByPhoto = new Array(photoCount);
                var approvedResponsesByPhoto = new Array(photoCount);
                var totalTests = 4;
                for (var i = 0; i < photoCount; i++) {
                    var approvalRating = new Array(totalTests);
                    var approvedOverall = true;
                    var strApproved = 'approved';
                    var strRejected = 'rejected';
                    // Create multidimensional part to store results per test
                    totalResponsesByPhoto[i] = [' ', ' ', ' ', ' '];
                    approvedResponsesByPhoto[i] = [' ', ' ', ' ', ' '];
                    // Manipulate DOM
                    $results.append(photoTemplate);
                    var $thisPhoto = $results.find('.section.clearfix').eq(i);
                    $thisPhoto.find('img').attr('src', 'data/photos/' + photos.photo[i].src);
                    $thisPhoto.find('.comment').text(photos.photo[i].comment);
                    $thisPhoto.find('.nickname').text(photos.photo[i].nickname);
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
                        // Calculate approval rates per test
                        approvalRating[j] = approvedResponsesByPhoto[i][j] / totalResponsesByPhoto[i][j];
                        $thisPhoto.find('ol').append(graphTemplate);
                        var $thisTest = $thisPhoto.find('li').eq(j);
                        if (approvalRating[j] > 0.5) {
                            $thisTest.addClass(strApproved);
                        }
                        else {
                            $thisTest.addClass(strRejected);
                            approvedOverall = false;
                        }
                        $thisTest.find('.percentage').css('width', Math.round(approvalRating[j] * 100) + '%');
                    }
                    // Was photo was approved across all tests?
                    if (approvedOverall) {
                        $thisPhoto.find('h2').addClass(strApproved).text(strApproved);
                        approvedCount++;
                    }
                    else {
                        $thisPhoto.find('h2').addClass(strRejected).text(strRejected);
                        rejectedCount++;
                    }
                    
                }
                $results.find('.tally').find('.'+strApproved).text(approvedCount);
                $results.find('.tally').find('.'+strRejected).text(rejectedCount);
            };
        </script>
    </body>
</html>
