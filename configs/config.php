<?php
	$TITLE = 'My Shop';

	//Настройки подключения к БД
	$HOST_DB = 'localhost';
	$USER_DB = 'root';
	$PASS_DB = '';
	$NAME_DB = 'myshop_db';

	//Время жизни сессии пользователя
	$TIME_LIVE = 2*60;

	//Смещение времени
	$TIME_OFFSET = 3*60*60;

	//Текущее время
	$CUR_TIME = time() + $TIME_OFFSET;
?>