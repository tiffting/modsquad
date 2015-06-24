
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
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
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

            <div class="section clearfix">
                <div class="col col-narrow">
                    <div class="inside">
                        <figure>
                            <img src="data/photos/photo-1.jpg" alt="" />
                            <figcaption>
                                <p>
                                    Got Rick Ross a new badass Yeti for Father's Day!! #ImHisFavoriteChild #Yeti #YetiCoolers
                                </p>
                                <p>
                                    <strong>By:</strong> bossross143
                                </p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col col-wide">
                    <div class="inside">
                        <h2 class="rejected">Rejected</h2>
                        <ol>
                            <li class="bar rejected">
                                <div></div>
                                <div class="percentage" style="width: 40%"></div>                            
                            </li>
                            <li class="bar approved">
                                <div></div>
                                <div class="percentage" style="width: 100%"></div>                            
                            </li>
                            <li class="bar approved">
                                <div></div>
                                <div class="percentage" style="width: 70%"></div>                            
                            </li>
                            <li class="bar approved">
                                <div></div>
                                <div class="percentage" style="width: 80%"></div>                            
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="section clearfix">
                <div class="col col-narrow">
                    <div class="inside">
                        <figure>
                            <img src="data/photos/photo-11.jpg" alt="" />
                            <figcaption>
                                <p>
                                    Adventures #yeticoolers #builtforthewild @yeticoolers instagram.com/p/3URYV6AJGe/
                                </p>
                                <p>
                                    <strong>By:</strong> Ryan Crook @CrookArmy
                                </p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col col-wide">
                    <div class="inside">
                        <h2 class="approved">Approved</h2>
                        <ol>
                            <li class="bar approved">
                                <div></div>
                                <div class="percentage" style="width: 80%"></div>                            
                            </li>
                            <li class="bar approved">
                                <div></div>
                                <div class="percentage" style="width: 100%"></div>                            
                            </li>
                            <li class="bar approved">
                                <div></div>
                                <div class="percentage" style="width: 70%"></div>                            
                            </li>
                            <li class="bar approved">
                                <div></div>
                                <div class="percentage" style="width: 80%"></div>                            
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
                }
                for (var i = 0; i < photoCount; i++) {
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
            };
        </script>
    </body>
</html>