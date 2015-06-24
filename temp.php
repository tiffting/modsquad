<?php
                echo '<div class="group-a">';
                foreach($json[photo] as $p) {
                    if($p[group] === 'a') {
                        echo '
                            <div class="carousel-and-form">
                                <div id="carousel-'.$p[id].'" class="carousel">
                                    <div>reject</div>
                        ';
                        if ($test !== '2') {
                            echo '
                                    <div class="photo"><img src="data/photos/'.$p[src].'" id="'.$p[id].'"/></div>
                            ';
                        }
                        else {
                            echo '
                                    <div class="text">
                                        <p id="'.$p[id].'">'.$p[comment].'<br/>by <strong>'.$p[nickname].'</strong></p>
                                    </div>
                            ';
                        }
                        echo '
                                    <div>approve</div>
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