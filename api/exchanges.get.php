<?php 
	require_once('settings.php');
	require_once('functions.php');

	define(ITEMS_PER_RPAGE, 20);

	$user_id = (isset($_GET['user_id'])) ? $_GET['user_id'] : null;

	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	$start = ($page - 1) * ITEMS_PER_RPAGE;
	

	if($user_id !== null) {
		
		$response = [];

		$query = "SELECT * FROM `exchanges` WHERE `origin_user_id`={$user_id} OR `target_user_id`={$user_id} LIMIT {$start}, " . ITEMS_PER_RPAGE;
		$exchanges = mysqli_query($link,$query);

		$count = mysqli_num_rows($exchanges);
		$pages = ceil($count / ITEMS_PER_RPAGE);

		$response[] = $pages;

		if ($page > $pages) {
		    e404('Нет такой страницы');
		}

		while($row = mysqli_fetch_assoc($exchanges)) {

			$curr_exch['state'] = $row['state'];

			$query = "SELECT * FROM `users` WHERE `id`={$row['target_user_id']}";
			$user = mysqli_query($link,$query);
			$curr_exch['target_user'] = mysqli_fetch_assoc($user);

			$query = "SELECT * FROM `users` WHERE `id`={$row['origin_user_id']}";
			$user = mysqli_query($link,$query);
			$curr_exch['origin_user'] = mysqli_fetch_assoc($user);

			$query = "SELECT title FROM `books` WHERE `id`={$row['target_book_id']}";
			$book = mysqli_query($link,$query);
			$curr_exch['target_book'] = mysqli_fetch_assoc($book)['title'];

			$query = "SELECT title FROM `books` WHERE `id`={$row['origin_book_id']}";
			$book = mysqli_query($link,$query);
			$curr_exch['origin_book'] = mysqli_fetch_assoc($book)['title'];  

			$response[] = $curr_exch;
		} 

		if(!$response){
			e404('У пользователя нет обменов');
		}	
	} else {
		e404('не передали user_id');
	}
	echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>