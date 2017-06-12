<?php 
	require_once('settings.php');
	require_once('functions.php');
	$id = isset($_GET['id']) ? $_GET['id'] : null;
	$state = isset($_GET['state']) ? $_GET['state'] : null;

	if($id && $state) {
		$query = "UPDATE `exchanges` SET `state` = '{$state}' WHERE `id` = '{$id}'";

		$result = mysqli_query($link,$query);
		if($result){
			response200('Статус изменен');
		} else {
			e404('Не удалось изменить статус');
		}
	} else {
		e404('Не введены данные');
	}