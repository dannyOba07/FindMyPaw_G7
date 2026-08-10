<?php
session_start();
require './app/controllers/userController.php';

$page = $_GET['page'] ?? 'login';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (($_GET['option'] ?? "") == "getProfile") {
        $auth = new userController();
        $auth->getProfile();
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['option'] == "login") {
        $auth = new userController();
        $auth->login();
        exit;
    }

    if ($_POST['option'] == "register") {
        $auth = new userController();
        $auth->register();
        exit;
    }

    if ($_POST['option'] == "updateProfile") {
        $auth = new userController();
        $auth->updateProfile();
        exit;
    }

    if ($_POST['option'] == "logout") {
        $auth = new userController();
        $auth->logout();
        exit;
    }
}

switch ($page) {

    case "showRegister":
        $auth = new userController();
        $auth->showRegister();
        break;

    case "profile":
        $auth = new userController();
        $auth->showProfile();
        break;

    default:
        $auth = new userController();
        $auth->showLogin();
        break;
}