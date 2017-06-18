<?php
require_once('settings.php');
require_once('functions.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    $query = "SELECT * FROM `book` WHERE `id` = '{$id}'";
    
    $result = mysqli_query($link, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    } else {
        e404('Такого id книги нет!');
    }
} else {
    e404('Данные о книге не переданы!');
}