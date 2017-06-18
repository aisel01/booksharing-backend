<?php

require_once('settings.php');
require_once('functions.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;
$name = isset($_GET['name']) ? $_GET['name'] : null;

if ($name !== null) {
    
    $query_user = "SELECT * FROM `users` WHERE `id` = '{$id}'";
    $result = mysqli_query($link, $query_user);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $query = "UPDATE `users` SET `username` = '{$name}' WHERE `id` = '{$id}'";
        $result = mysqli_query($link, $query);
        
        echo json_encode('Пользователь отредактирован!');
    } else {
        $query = "INSERT INTO `users` (`id`, `username`) VALUES (NULL, '{$name}');";
        $result = mysqli_query($link, $query);
        
        echo json_encode('Пользователь добавлен!');
    }
} else {
    e404('Данные не переданы!');
}