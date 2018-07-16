<?php 

function msToTime($duration) {

    $milliseconds = ($duration%1000)/100;
    $seconds = ($duration/1000)%60;
    $minutes = ($duration/(1000*60))%60;
    $hours = ($duration/(1000*60*60))%24;
    return $hours . ":" . $minutes . ":" . $seconds ;
}


?>