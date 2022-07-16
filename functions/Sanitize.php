<?php
function escape($string){
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function dd($string) {
    return "<pre>" . print_r($string) . "</pre>";
}