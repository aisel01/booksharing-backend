<?php
require_once 'functions.php';

header('Content-type: application/json');

$isbn = isset($_GET['isbn']) ? $_GET['isbn'] : null;

if ($isbn !== null) {
    $url = 'https://www.googleapis.com/books/v1/volumes?q=' . $isbn;
    
    $response = @file_get_contents($url);
    $json = json_decode($response);

    if (isset($json->items)) {
        do {
            $item = array_shift($json->items);
            if (!$item) {
                break;
            }
            $identifier = get_isbn_13($item->volumeInfo->industryIdentifiers);
        } while ($identifier !== $isbn);

        if ($identifier === $isbn) {
            $response = [
                'title' => $item->volumeInfo->title,
                'description' => $item->volumeInfo->description,
                'authors' => $item->volumeInfo->authors,
                'image' => $item->volumeInfo->imageLinks->thumbnail,
                'pageCount' => $item->volumeInfo->pageCount,
                'rating' => $item->volumeInfo->averageRating
            ];

            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            e404('Книга не найдена');    
        }
    } else {
        e404('Книги не найдены');
    }
} else {
    e404('Данные не переданы');
}
