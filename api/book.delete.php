<?php
require_once('settings.php');
require_once('functions.php');

if (!isAuthed()) e404('не авторизован');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    $query_book = "SELECT * FROM `book` WHERE `id` = '{$id}'";
    $result = mysqli_query($link, $query_book);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $query = "DELETE FROM `book` WHERE `id` = '{$id}'";
        $result = mysqli_query($link, $query);
        
        echo json_encode('Книга удалена!');
    } else {
        e404('Такого id книги нет!');
    }
} else {
    e404('Данные не переданны!');
}