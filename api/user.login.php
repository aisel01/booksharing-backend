<?php
require_once('settings.php');
require_once('functions.php');

$username = isset($_GET['username']) ? $_GET['username'] : null;
$password = isset($_GET['password']) ? $_GET['password'] : null;

if (($username !== null)&&($password !== null)) {
    if (checkAuth($username, $password)) {
        $password = md5($password);

        setcookie('username', $username, time() + 3600);
        setcookie('password', $password, time() + 3600);
        
        response200([
            'password' => $password
        ]);
    } else {
        e404('Авторизация не успешна');
    }
} else {
    e404('Данные не переданы!');
}