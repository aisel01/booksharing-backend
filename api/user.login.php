<?php

require_once('settings.php');
require_once('functions.php');

$username = isset($_GET['username']) ? $_GET['username'] : null;
$password = isset($_GET['password']) ? $_GET['password'] : null;

$password = md5($password); // TODO солить пароли

if (($name !== null)&&($password !== null)) {
    if (checkAuth($username, $password)) {
        $password = md5($password);

        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        respose200([
            'password' => $password
        ]);
    } else {
        e404('Авторизация не успешна');
    }
} else {
    e404('Данные не переданы!');
}