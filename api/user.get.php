<?php
require_once('settings.php');
require_once('functions.php');
//header('Content-type: application/json');

$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) $id = getCurrentUserId();

if ($id !== null) {
    $query = "SELECT * FROM `users` WHERE `id` = '{$id}'";
    
    $result = mysqli_query($link, $query);
    
    if($row_user = mysqli_fetch_assoc($result)) {
        $query_book = "SELECT * FROM `book` WHERE `user_id` = '{$row_user['id']}'";
        $result = mysqli_query($link, $query_book);

        if($row_book = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
            
            $responce = [
                'user' => $row_user,
                'books' => $row_book
            ];
            echo json_encode($responce, JSON_UNESCAPED_UNICODE);
        } else {
            $responce = [
                'user' => $row_user,
                'books' => []
            ];
            echo json_encode($responce, JSON_UNESCAPED_UNICODE);
        }
    } else {
        e404('Такого id пользователя нет!');
    }
} else {
    e404('Данные о пользователе не переданы!');
}