<?php
    include "../core/Init.php";
    include '../functions/Sanitize.php';
    spl_autoload_register(fn ($class) => require_once '../classes/' . $class . '.php');

    $comment = new Comments();
    $comment->delete();
?>