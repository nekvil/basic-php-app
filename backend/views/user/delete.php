<?php
require_once '../../config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/controllers/UserController.php';
UserController::actionDeleteUser();
?>
