<?php
$config = array(
	'title' => 'It-Blog',
	'urls' => array(
		'vk-url' => 'https://vk.com/timoxgagarin',
		'about-me' => 'http://php-blog/pages/about-me/about-me.php',
		'main' => 'http://php-blog/',
	),
	'db' => array(
		'server' => '127.0.0.1',
		'username' => 'root',
		'password' => 'root',
		'database' => 'php-blog',
	),
);

require "db.php";
?>