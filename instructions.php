<?php

	$titles = array('Pass the Prude', 'You\'re Doing it Wrong', 'What a Jerk!', 'Derp.');

	$left1 = <<<EOD
<div class="section instruction left">
                <p>
                    <strong>Swipe LEFT</strong> if the photo would <strong>make Ned Flanders uncomfortable</strong>:
                </p>
                <ul>
                    <li>It has violence, nudity, or other R-rated stuff, or</li>
                    <li>It's mean-spirited</li>
                </ul>
            </div>
EOD;

	$left2 = <<<EOD
<div class="section instruction left">
                <p>
                    <strong>Swipe LEFT</strong> if the contributor <strong>didn't get the assignment</strong>:
                </p>
                <ul>
                    <li>It's not in English (this is 'merica!),</li>
                    <li>It has PII (like someone's phone number), or </li>
                    <li>It's spam</li>
                </ul>
            </div>
EOD;

$left3 = <<<EOD
<div class="section instruction left">
                <p>
                    <strong>Swipe LEFT</strong> if the photo <strong>was taken by a jerk</strong>:
                </p>
                <ul>
                    <li>It has obscene gestures or whatever, or</li>
                    <li>It could get YETI in trouble</li>
                </ul>
            </div>
EOD;

$left4 = <<<EOD
<div class="section instruction left">
                <p>
                    <strong>Swipe LEFT</strong> if there's no YETI</strong>.
                </p>
                <ul>
                    <li>Photo's nice, but there's no YETI product, or
                    </li>
                    <li>You wouldn't know because the photo's a blurry mess!</li>
                </ul>
            </div>
EOD;

	$left = array(
		$left1, 
		$left2, 
		$left3, 
		$left4
	);

?>