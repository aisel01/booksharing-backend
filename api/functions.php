<?php 
function e404($message) {
    header('HTTP/1.1 404 Not Found');
    $response = [
        'message' => $message
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit();
}

function response200($message = 'ok') {
    $response = [
        'message' => $message
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit();        
}

function extractById($id, $rows) {
    foreach ($rows as $value) {
        if($value['id'] == $id) return $value;
    }
}

function get_isbn_13($ids) {
    foreach($ids as $isbn) {
        if ($isbn->type === 'ISBN_13') return $isbn->identifier;
    }
}

function checkAuth($user, $password, $session = false) {
    if (!$session) {
        $password = md5($password);
    }

    $query_user = "SELECT * FROM `users` WHERE (`username` = '{$username}') AND (`password` = '{$password}')";
    $result = mysqli_query($link, $query_user);
        
    if ($row = mysql_fetch_row($result)) {
        return true;
    }

    return false;
}

function userAuthed() {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
    $password = isset($_SESSION['password']) ? $_SESSION['password'] : null;

    if (checkAuth($username, $password, true)) {
        return true;
    } else {
        return false;
    }
}