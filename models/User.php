<?php

class User {

    const ADMIN_LOGIN = "admin";
    const ADMIN_PASSWORD = "123";

    public static function checkUserData($name, $password) {

        if ($name == self::ADMIN_LOGIN && $password == self::ADMIN_PASSWORD) {
            return true;
        }

        return false;
    }

    public static function auth($name) {

        $_SESSION['name'] = $name;
        $_SESSION['sort_field'] = 0;
        $_SESSION['sort_organize'] = 1;
    }

    public static function checkAuth() {

        if (isset($_SESSION['name'])) {
            return true;
        }

        header("Location: /user/login");
        return false;
    }

    public static function isGuest() {

        if (isset($_SESSION['name'])) {
            return false;
        }

        return true;
    }

    public static function checkName($name) {

        if (strlen($name) >= 3 && strlen($name) <= 16) {
            return true;
        }

        return false;
    }

}
