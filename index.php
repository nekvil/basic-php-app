<?php
require_once 'backend/config/config.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case BASE_PATH:
        include 'frontend/controllers/SiteController.php';
        SiteController::actionIndex();
        break;
    default:
        include 'frontend/includes/404.php';
        break;
}

?>
