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

function checkAuth($username, $password, $session = false) {
    global $link;

    if (!$session) {
        $password = md5($password);
    }

    $query_user = "SELECT * FROM `users` WHERE (`username` = '{$username}') AND (`password` = '{$password}')";
    $result = mysqli_query($link, $query_user);

    if ($row = mysqli_fetch_row($result)) {
        return true;
    }

    return false;
}

function isAuthed() {
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
    $password = isset($_SESSION['password']) ? $_SESSION['password'] : null;

    if (checkAuth($username, $password, true)) {
        return true;
    } else {
        return false;
    }
}

function cors() {
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        exit(0);
    }
}
cors();