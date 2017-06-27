<?php
	require_once('settings.php');
	require_once('functions.php');

	if (!isAuthed()) e404('не авторизован');
	
	define('ITEMS_PER_PAGE', 20);

	$user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : null;

	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	$start = ($page - 1) * ITEMS_PER_PAGE;	

	if($user_id !== null) {
		
		$response = [];

		$query = "SELECT  COUNT(*) FROM `exchanges` WHERE (`origin_user_id`='{$user_id}' OR `target_user_id`='{$user_id}')";
		$result = mysqli_query($link,$query);
		$count = null;
		if ($row = mysqli_fetch_row($result)) {
			$count = $row[0];
		}

		$pages = ceil($count / ITEMS_PER_PAGE);
		if ($page > $pages) {
		    e404('Нет такой страницы');
		}

		$query = "SELECT * FROM `exchanges` WHERE (`origin_user_id`='{$user_id}') OR (`target_user_id`='{$user_id}') LIMIT {$start}, " . ITEMS_PER_PAGE;

		$result = mysqli_query($link,$query);
		$exchanges = [];

		while($row = mysqli_fetch_assoc($result)) {
			$curr_exch['id'] = $row['id'];
			$curr_exch['state'] = $row['state'];

			$query = "SELECT * FROM `users` WHERE `id` IN ('{$row['origin_user_id']}', '{$row['target_user_id']}')"; 
			$users_result = mysqli_query($link,$query); 

			$curr_exch['target_user'] = extractById($row['target_user_id'],$users_result);
			$curr_exch['origin_user'] = extractById($row['origin_user_id'],$users_result);

			$query = "SELECT * FROM `books` WHERE `id` IN ('{$row['origin_book_id']}', '{$row['target_book_id']}')";
			$books_result = mysqli_query($link,$query); 

			$curr_exch['target_book'] = extractById($row['target_book_id'],$books_result);
			$curr_exch['origin_book'] = extractById($row['origin_book_id'],$books_result);

			$exchanges[] = $curr_exch;
		} 

		$response = [
		    'total_pages' => $pages,
		    'exchanges' => $exchanges
		];
		
	} else {
		e404('не передали user_id');
	}
	echo json_encode($response, JSON_UNESCAPED_UNICODE);