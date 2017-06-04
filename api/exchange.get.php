<?php 
	require_once('settings.php');
	require_once('functions.php');
	$id = isset($_GET['id']) ? $_GET['id'] : null;

	if($id !== null) {
		$query = "SELECT * FROM exchanges WHERE id={$id}";
		$result = mysqli_query($link,$query);
		if($row = mysqli_fetch_assoc($result)) {
			$response['state'] = $row['state'];

			$query = "SELECT * FROM users WHERE id={$row['origin_user_id']}";
			$origin_user_result = mysqli_query($link,$query);
			$response['origin_user'] = mysqli_fetch_assoc($origin_user_result);

			$query = "SELECT * FROM users WHERE id={$row['target_user_id']}";
			$target_user_result = mysqli_query($link,$query);
			$response['target_user'] = mysqli_fetch_assoc($target_user_result);

			$query = "SELECT * FROM books WHERE id={$row['origin_book_id']}";
			$origin_book_result = mysqli_query($link,$query);
			$response['origin_book'] = mysqli_fetch_assoc($origin_book_result);

			$query = "SELECT * FROM books WHERE id={$row['target_book_id']}";
			$target_book_result = mysqli_query($link,$query);
			$response['target_book'] = mysqli_fetch_assoc($target_book_result);

		} else {
			e404('Такого обмена нет');
		}
	} else {
		e404('Не передали id');
	}
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
 ?>