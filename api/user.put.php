<?php
require_once('settings.php');
require_once('functions.php');

$username = isset($_GET['username']) ? $_GET['username'] : null;
$password = isset($_GET['password']) ? $_GET['password'] : null;

$password = md5($password); // TODO солить пароли

if (isAuthed()) {
    $username = $_SESSION['username'];

    $query = "UPDATE `users` SET `password` = '{$password}' WHERE `username` = '{$username}'";
    $result = mysqli_query($link, $query);
    
    echo response200([
        'message' => 'Пользователь отредактирован!',
        'password' => $password
    ]);
} else {
    $query_user = "SELECT * FROM `users` WHERE `username` = '{$username}'";
    $result = mysqli_query($link, $query_user);
    
    if ($row = mysqli_fetch_row($result)) {
        e404('Такой пользователь уже существует');
    } else {
        $query = "INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, '{$username}', '{$password}');";
        $result = mysqli_query($link, $query);

        if ($result) {
            response200([
                'id' => mysqli_insert_id($link),
                'password' => $password
            ]);
        } else {
            e404('Ошибка БД');
        }
    }
}
