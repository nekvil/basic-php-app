<?php
require_once 'config/config.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/UserController.php';

// Проверяем, авторизован ли пользователь
$isLoggedIn = AuthController::isLoggedIn();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case BASE_PATH . 'backend/':
        header("Location: " . BASE_PATH . 'backend/auth/');
        exit();
        break;
    case BASE_PATH . 'backend/auth/':
        if (!$isLoggedIn) {
            AuthController::actionIndex();
        } else {
            header("Location: " . BASE_PATH . 'backend/user/');
            exit();
        }
        break;
    case BASE_PATH . 'backend/user/':
        if ($isLoggedIn) {
            UserController::actionIndex();
        } else {
            header("Location: " . BASE_PATH . 'backend/auth/');
            exit();
        }
        break;
    case BASE_PATH . 'backend/auth/logout':
        AuthController::actionLogout();
        break;
    default:
        include 'includes/404.php';
        break;
}

?>
