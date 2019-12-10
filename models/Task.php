<?php

class Task {

    const SHOW_DEFAULT = 3;
    const IMG_MAX_WIDTH = 320;
    const IMG_MAX_HEIGHT = 240;

    public static function getTaskList($page = 1, $sortField = 0, $sortOrganize = 1) {

        $sortField = intval($sortField);
        $sortOrganize = intval($sortOrganize);

        switch ($sortField) {
            case 0: $sortField = "task_id";
                break;
            case 1: $sortField = "task_user_name";
                break;
            case 2: $sortField = "task_email";
                break;
            case 3: $sortField = "task_status";
                break;
        }
        switch ($sortOrganize) {
            case 1: $sortOrganize = "ASC";
                break;
            case 2: $sortOrganize = "DESC";
                break;
        }

        $page = intval($page);
        $count = self::SHOW_DEFAULT;
        $offset = ($page - 1) * $count;

        $db = Db::getConnection();
        $query = "SELECT * "
                . "FROM task "
                . "ORDER BY $sortField $sortOrganize "
                . "LIMIT $count "
                . "OFFSET $offset";
        $result = $db->query($query);

        if ($result) {
            foreach ($result as $row) {
                $taskList[] = array(
                    'task_id' => $row['task_id'],
                    'task_user_name' => $row['task_user_name'],
                    'task_email' => $row['task_email'],
                    'task_text' => $row['task_text'],
                    'task_status' => $row['task_status'],
                );
            }
        }

        return $taskList;
    }

    public static function getTaskItemById($id) {

        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();
            
            $query = "SELECT * "
                    . "FROM task "
                    . "WHERE task_id = " . $id;
            $result = $db->query($query);
            
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $taskItem = $result->fetch();

            return $taskItem;
        }
    }

    public static function getTotalTasks() {

        $db = Db::getConnection();

        $query = "SELECT COUNT(task_id) AS count "
                . "FROM task";
        $result = $db->query($query);
        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    public static function add($name, $email, $text) {

        $db = Db::getConnection();

        $query = "INSERT INTO task SET "
                . "task_user_name = :name, "
                . "task_email = :email, "
                . "task_text = :text";

        $result = $db->prepare($query);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function edit($id, $text, $status = 0) {

        $db = Db::getConnection();

        $query = "UPDATE task SET "
                . "task_text = :text, "
                . "task_status = :status "
                . "WHERE task_id = :id";

        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);

        return $result->execute();
    }




    public static function checkEmail($email) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }

}
