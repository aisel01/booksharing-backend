<?php
require_once('settings.php');
require_once('functions.php');

if (!isAuthed()) e404('не авторизован');

$query = 'SELECT * FROM `users`';

$result = mysqli_query($link, $query);

if ($row = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
} else {
    e404('Данных о пользователей нет!');
}
