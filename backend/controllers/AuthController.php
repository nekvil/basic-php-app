<?php
class AuthController {
    public static function actionLogin() {
        $error_message = null;
        $login_attempts_key = 'login_attempts';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['authenticated'] = true;
                $_SESSION['login_time'] = time();

                header("Location: " . BASE_PATH . "backend/user/");
                exit();
            } else {
                if (!isset($_SESSION[$login_attempts_key])) {
                    $_SESSION[$login_attempts_key] = 1;
                } else {
                    $_SESSION[$login_attempts_key]++;
                }

                if ($_SESSION[$login_attempts_key] >= MAX_LOGIN_ATTEMPTS) {
                    $_SESSION['login_blocked'] = true;
                    $_SESSION['login_blocked_time'] = time() + LOGIN_BLOCK_DURATION;
                }

                $error_message = "Invalid username or password";
            }
        }

        return $error_message;
    }

    public static function actionLogout() {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        session_destroy();
        header("Location: " . BASE_PATH . "backend/auth/");
        exit();
    }

    public static function actionIndex($error_message = null) {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if (isset($_SESSION['login_blocked']) && $_SESSION['login_blocked']) {
            if (time() < $_SESSION['login_blocked_time']) {
                require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/includes/login_blocked.php';
            } else {
                unset($_SESSION['login_blocked']);
                unset($_SESSION['login_blocked_time']);
                unset($_SESSION['login_attempts']);

                header("Refresh:0");
                exit();
            }
        } else {
            require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/views/auth/index.php';
        }
    }

    public static function isLoggedIn() {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true &&
               isset($_SESSION['login_time']) && (time() - $_SESSION['login_time']) < SESSION_DURATION;
    }
}

