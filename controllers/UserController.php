<?php

class UserController {

    public function actionLogin() {

        if (User::isGuest()) {
            if (isset($_POST['submit'])) {
                $name = htmlspecialchars($_POST['name']);
                $password = htmlspecialchars($_POST['password']);

                $errors = false;

                if (!User::checkName($name)) {
                    $errors[] = 'Поле "Имя" должно содержать от 3 до 16 символов!';
                }

                $userChecked = User::checkUserData($name, $password);

                if ($userChecked == false) {
                    $errors[] = 'Неверный логин или пароль!';
                } else {
                    User::auth($name);
                    header("Location: /");
                }
            }
        } else {
            header("Location: /");
        }

        require_once ROOT . '/views/user/login.php';
        return true;
    }

    public function actionLogout() {

        unset($_SESSION['name']);
        header("Location: /");
    }

}
