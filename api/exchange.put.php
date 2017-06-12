<?php 
	require_once('settings.php');
	require_once('functions.php');

	$origin_user_id = isset($_GET['origin_user_id']) ? $_GET['origin_user_id'] : null;
	$target_user_id = isset($_GET['target_user_id']) ? $_GET['target_user_id'] : null;
	
	$target_book_id = isset($_GET['target_book_id']) ? $_GET['target_book_id'] : null;
	$origin_book_id = isset($_GET['origin_book_id']) ? $_GET['origin_book_id'] : null;

	$state = 'предложение';

	if($origin_user_id && $target_user_id && $target_book_id && $origin_book_id) {
		$query = " INSERT INTO `exchanges` (`origin_user_id`, `target_user_id`, `state`, `target_book_id`, `origin_book_id`) VALUES
	    	('{$origin_user_id}', '{$target_user_id}', '{$state}', '{$target_book_id}', '{$origin_book_id}')";
		$result = mysqli_query($link,$query);

		if($result){
			response200('Обмен предложен');
		} else {
			e404('Не удалось предложить обмен');
		}
	} else {
		e404('Не введены данные');
	}