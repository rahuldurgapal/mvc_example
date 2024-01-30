<?php
include("model/UserModel.php");

class AuthController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new UserModel($conn);
    }

    // Registration function
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');

            // Perform validation on $username and $password
            if (!$username || !$password) {
                echo "Invalid username or password";
                return;
            }
            
            // Hash the password
        //    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Proceed with user registration
            $this->userModel->createUser(['username' => $username, 'password' => $password]);

            // Redirect to login page after successful registration
            header("location: index.php?action=login");
            exit();
        }
        include("view/auth/register.php");
    }

    // Login Function
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');

            echo $username . " " . $password;

            if (!$username || !$password) {
                echo "Invalid username or password 3";
                return;
            }

            // Proceed with authentication
            $user = $this->userModel->getUserByUsername($username);
            print_r($user);
            echo $user['password'];
            if ($user && $password==$user['password']) {
                // Successful login, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Redirect to student panel after successful login
                header("location: index.php?action=panel");
                exit();
            } else {
                // Failed login, show error message
                echo "Invalid username or password 4";
            }
        }
        include("view/auth/login.php");
    }

    // Logout Function
    public function logout() {
        // Destroy the session and redirect to the login page
        session_destroy();
        header("location: index.php?action=login");
        exit();
    }
}
?>
