<?php


class StudentController {

    private $userModel;

    
    public function __construct($conn) {
        $this->userModel = new UserModel($conn);
    }

    public function panel() {

        //Ensure that the user is logged in
        if(!isset($_SESSION['user_id'])) {
            header("location: index.php?action=login");
            exit();
        }

        //Fetch user details
        $user = $this->userModel->getUserByUsername($_SESSION['username']);

        //Handle form submission for updating profile
        if($_SERVER['REQUEST_METHOD']==="POST") {
            $course = filter_input(INPUT_POST, 'courses');
            $class = filter_input(INPUT_POST, 'class');

         
            //Update user profile
            $this->userModel->updateUser($user['id'],['courses'=> $course, 'class'=>$class]);

            header("location: index.php?action=panel");
        }

        include("view/student/panel.php");
    }
}



?>