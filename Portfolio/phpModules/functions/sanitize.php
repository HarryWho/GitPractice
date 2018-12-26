<?php
function escape($string){
    return htmlentities($string, ENT_QUOTES,'UTF-8');
}

function full_url( $s, $use_forwarded_host = false ) {
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}
  