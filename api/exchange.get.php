<?php 
	require_once('settings.php');
	require_once('functions.php');

	$id = isset($_GET['id']) ? $_GET['id'] : null;

	if($id !== null) {
		$query = "SELECT * FROM `exchanges` WHERE `id`='{$id}'";
		$result = mysqli_query($link,$query);
		if($row = mysqli_fetch_assoc($result)) {
			$response['state'] = $row['state'];

			$query = "SELECT * FROM `users` WHERE `id` IN ('{$row['origin_user_id']}', '{$row['target_user_id']}')";
			$users_result = mysqli_query($link,$query); 

			while($row_user = mysqli_fetch_assoc($users_result)) $users_rows[] = $row_user;

			$response['origin_user'] = extractById($row['origin_user_id'],$users_rows);
			$response['target_user'] = extractById($row['target_user_id'],$users_rows);			
			
			$query = "SELECT * FROM `books` WHERE `id` IN ('{$row['origin_book_id']}', '{$row['target_book_id']}')";			
			$books_result = mysqli_query($link,$query);

			while($row_book = mysqli_fetch_assoc($books_result)) $books_rows[] = $row_book;

			$response['origin_book'] = extractById($row['origin_book_id'],$books_rows);
			$response['target_book'] = extractById($row['target_book_id'],$books_rows);
		} else {
			e404('Такого обмена нет');
		}
	} else {
		e404('Не передали id');
	}
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
 ?>