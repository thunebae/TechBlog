<?php
function linkCSS($cssPath){
    $url = URL_ROOT . "/" . $cssPath;
    echo ' <link href="'. $url .'" rel="stylesheet">';
}
?>