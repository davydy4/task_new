<?php

class TaskController {

    public function actionIndex($page = 1, $sortField = 0, $sortOrganize = 1) {

        if (isset($_POST['submit'])) {
            $_SESSION['sort_field'] = intval($_POST['sortField']);
            $_SESSION['sort_organize'] = intval($_POST['sortOrganize']);
        }

        if (
                !isset($_SESSION['sort_field']) &&
                !isset($_SESSION['sort_organize'])
        ) {
            $_SESSION['sort_field'] = 0;
            $_SESSION['sort_organize'] = 1;
        }

        $taskList = Task::getTaskList($page, $_SESSION['sort_field'], $_SESSION['sort_organize']);
        $total = Task::getTotalTasks();
        $pagination = new Pagination($total, $page, Task::SHOW_DEFAULT, 'p');

        require_once(ROOT . '/views/task/index.php');
        return true;
    }


    public function actionAdd() {

        if (isset($_POST['submit'])) {

            $errors = false;

            $name = htmlspecialchars($_POST['name']);
            $email = $_POST['email'];
            $text = htmlspecialchars($_POST['text']);


            if (!User::checkName($name)) {
                $errors[] = 'Поле "Имя" должно содержать от 3 до 16 символов!';
            }

            if (!Task::checkEmail($email)) {
                $errors[] = 'Неверный "E-mail"!';
            }

            if ($text == '') {
                $errors[] = 'Поле "Текст заказа" пустое!';
            }


            if ($errors == false) {
                $result = Task::add($name, $email, $text);
            }
        }

        require_once(ROOT . '/views/task/add.php');
        return true;
    }

    public function actionEdit($id) {

        User::checkAuth();

        $taskItem = Task::getTaskItemById($id);
        if (isset($_POST['submit'])) {

            $text = htmlspecialchars($_POST['text']);
            if (isset($_POST['status'])) {
                $status = intval($_POST['status']);
            }

            $result = Task::edit($id, $text, $status);
        }

        require_once(ROOT . '/views/task/edit.php');
        return true;
    }

}
