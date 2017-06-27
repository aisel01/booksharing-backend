<?php
require_once('settings.php');
require_once('functions.php');

$search = isset($_GET['search']) ? $_GET['search'] : null;

if($search !== null) {
	$query = "SELECT * FROM `books` WHERE `title` LIKE '%{$search}%'";
	$result = mysqli_query($link,$query);

	$books = [];
	while($row = mysqli_fetch_assoc($result)) {
		$books[] = $row;
	}
	echo json_encode($books, JSON_UNESCAPED_UNICODE);
} else {
	e404('Данные не переданы');
}