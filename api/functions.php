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
 ?>