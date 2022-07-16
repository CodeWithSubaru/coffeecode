<?php
    include "../core/Init.php";
    include '../functions/Sanitize.php';
    spl_autoload_register(fn ($class) => require_once '../classes/' . ucfirst(strtolower($class)) . '.php');

    $category = new Category();
    $category->delete();
?>