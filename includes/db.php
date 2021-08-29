<?php
	$connection = mysqli_connect(
		$config['db']['server'],
		$config['db']['username'],
		$config['db']['password'],
		$config['db']['database']
	);//Подключение к БД
	if($connection == false){
		echo "Не удалось подключиться к базе данных<br>";
		echo mysqli_connect_error();//Ошибка подключения
		exit();
	}
?>