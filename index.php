<?php
require_once "class_loader.php";


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


use Controller\EntryController;

$controller = new EntryController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->submitForm();
}


$load = !empty($_GET['view']) ? $_GET['view'] : 'main';

if (file_exists("$load.php")) {
    require_once "Views/$load.php";
    exit();
}
require_once "Views/main.php";

?>
