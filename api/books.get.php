<?php
require_once('settings.php');
require_once('functions.php');

if (!isAuthed()) e404('не авторизован');

$query = 'SELECT * FROM `book` ORDER BY `user_id` DESC';

$result = mysqli_query($link, $query);

if ($row = mysqli_fetch_all($result, MYSQLI_ASSOC)){
    echo json_encode($row, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([], JSON_UNESCAPED_UNICODE);
}
