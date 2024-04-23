<?php
class UserController {
    public static function actionIndex() {
        require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/views/user/index.php';
    }

    public static function actionFetchUsers() {
        require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/models/UserModel.php';
        $userModel = new UserModel();
        
        $users = $userModel->getUsers();
    
        ob_start();
        include $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/views/user/table.php';
        $tableData = ob_get_clean();
    
        echo $tableData;
    }

    public static function actionCreateUser() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $response = ['success' => false, 'message' => 'Invalid request method'];
            echo json_encode($response);
            return;
        }
    
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        
        if (empty($name) || empty($email) || empty($password)) {
            $response = ['success' => false, 'message' => 'Required data is missing'];
            echo json_encode($response);
            return;
        }
    
        $name = strip_tags($name);
        $email = strip_tags($email);
    
        $name = htmlspecialchars($name);
        $email = htmlspecialchars($email);
    
        if (strlen($name) < MIN_NAME_LENGTH || strlen($name) > MAX_NAME_LENGTH) {
            $response = ['success' => false, 'message' => 'Invalid name length'];
            echo json_encode($response);
            return;
        }
    
        if (strlen($password) < MIN_PASSWORD_LENGTH || strlen($password) > MAX_PASSWORD_LENGTH) {
            $response = ['success' => false, 'message' => 'Invalid password length'];
            echo json_encode($response);
            return;
        }
    
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$email) {
            $response = ['success' => false, 'message' => 'Invalid email format'];
            echo json_encode($response);
            return;
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/models/UserModel.php';
        $userModel = new UserModel();
        
        if ($userModel->getUserByEmail($email)) {
            $response = ['success' => false, 'message' => 'Email already exists'];
            echo json_encode($response);
            return;
        }

        $success = $userModel->createUser($name, $email, $password);
        if ($success) {
            $response = ['success' => true, 'message' => 'User added successfully'];
            echo json_encode($response);
        } else {
            $response = ['success' => false, 'message' => 'Failed to add user'];
            echo json_encode($response);
        }
    }
    

    public static function actionDeleteUser() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['user_id'])) {
            $response = ['success' => false, 'message' => 'Invalid request'];
            echo json_encode($response);
            return;
        }

        $userId = $_POST['user_id'];

        require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/models/UserModel.php';
        $userModel = new UserModel();

        $success = $userModel->deleteUser($userId);
        if ($success) {
            $response = ['success' => true, 'message' => 'User deleted successfully'];
            echo json_encode($response);
        } else {
            $response = ['success' => false, 'message' => 'Failed to delete user'];
            echo json_encode($response);
        }
    }
}

?>
