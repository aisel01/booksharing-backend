<?php
require_once('settings.php');
require_once('functions.php');

if (!isAuthed()) e404('не авторизован');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    
    $query = "SELECT * FROM `users` WHERE `id` = '{$id}'";
    $result = mysqli_query($link, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        
        $query_book = "SELECT * FROM `book` WHERE `user_id` = '{$id}'";
        $result = mysqli_query($link, $query_book);

        if ($row = mysqli_fetch_assoc($result)) {
            e404('У пользователя есть книги!');
        } else {
            $query_user = "DELETE FROM `users` WHERE `id` = '{$id}'";
            $result = mysqli_query($link, $query_user);

            echo json_encode('Пользователь удален!');
        }
    } else {
        e404("Такого id пользователя нет!");
    }
} else { 
    e404('Данные о пользователе не переданны!');
} 