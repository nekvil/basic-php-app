<?php
class UserController {
    public static function actionIndex() {
        require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/views/user/index.php';
    }

    public static function actionFetchUsers() {
        require_once $_SERVER['DOCUMENT_ROOT'] . BASE_PATH . 'backend/models/UserModel.php';
        $userModel = new UserModel();
        
        $result = $userModel->getUsers();
    
        if (count($result) > 0) {
            $tableData = '';

            foreach ($result as $row) {
                $tableData .= '<tr>';
                $tableData .= '<td>' . $row['id'] . '</td>';
                $tableData .= '<td>' . $row['name'] . '</td>';
                $tableData .= '<td>' . $row['email'] . '</td>';
                $tableData .= '<td>' . $row['password'] . '</td>';
                $tableData .= '<td>' . $row['created_at'] . '</td>';
                $tableData .= '<td><button class="deleteUser btn btn-danger btn-sm" data-id="' . $row['id'] . '"><i class="bi bi-trash"></i></button></td>';
                $tableData .= '</tr>';
            }

            echo $tableData;
        } else {
            echo "<tr><td colspan='6'>No users found.</td></tr>";
        }
    }

    public static function actionCreateUser() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $response = ['success' => false, 'message' => 'Invalid request method'];
            echo json_encode($response);
            return;
        }
    
        if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
            $response = ['success' => false, 'message' => 'Required data is missing'];
            echo json_encode($response);
            return;
        }
    
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        if (!is_string($name) || !is_string($email) || !is_string($password)) {
            $response = ['success' => false, 'message' => 'Invalid data format'];
            echo json_encode($response);
            return;
        }

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
