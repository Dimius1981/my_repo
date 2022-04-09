<?php
	$path = './templates/';

	// http://myshop/?page=about

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = '';
	}

	if (isset($_GET['group'])) {
		$group = $_GET['group'];
	} else {
		$group = 0;
	}





	//print_r($_POST);

	//проверка на авторизацию
	if (!empty($_POST['login']) && !empty($_POST['pass'])) {
		//echo "Authorization\n";
		authorization($_POST['login'], $_POST['pass']);
		header('Location: ./', true, 301);
	}

	//Запросим инфу о сессии пользователя
	if (!isset($_SESSION['id'])) {
		$session_id = -1;
	} else {
		$session_id = $_SESSION['id'];
	}
	//print_r($session_id);

	//Запросим информацию о пользователе
	$user_info = userinfo($session_id);
	//$user_info = userinfo(1);
	//print_r($user_info);

	if ($user_info) {
		$cur_time_unix = $CUR_TIME;
		$login_time_unix = strtotime($user_info['date_login']);

		$user_time = $cur_time_unix - $login_time_unix;

		//echo "CUR_TIME = ".date("Y-m-d H:i:s", $cur_time_unix)."\n";
		//echo $cur_time_unix."\n";
		//echo $login_time_unix."\n";
		//echo $user_time."\n";

		//http://myshop/?logout=true
		//Проверка на выход пользователя
		if ((isset($_GET['logout'])) || ($user_time > $TIME_LIVE)) {
			session_destroy();
			header('Location: ./', true, 301);
		} else {
			usertimeupdate($session_id);
		}
	}







//Главная страница
//============================================================================
	if ($page == '') {
		$content = "{include file='content/products_view.tpl'}";












//Страница отображения товаров
//============================================================================
   } elseif ($page == 'products') {
		$content = "{include file='content/products_view.tpl'}";





//Страница О магазине...
//============================================================================
	} elseif ($page == 'about') {
		include('./templates/content/about.php');
		$content = $content_about;





//Страница Акции
//============================================================================
	} elseif ($page == 'act_page') {
		$content = '<h3>Action page</h3>';









//Страница Корзина
//============================================================================
	} elseif ($page == 'cart') {
		$content = '<h3>Cart page</h3>';






//JSon GET группа товаров по id
//============================================================================
	} elseif ($page == 'jgroup') {
		$content = '<h3>JSon group products</h3>';





//Запрос на добавление/изменение групп товаров
//============================================================================
	} elseif ($page == 'groupsubmit') {
		$content = '<h3>Group submit page</h3>';




//Запрос на удаление группы товаров
//============================================================================
	} elseif ($page == 'groupdelete') {
		$content = '<h3>Group delete page</h3>';




//AJAX вывод каталога меню
//============================================================================
	} elseif ($page == 'catalog_view') {
		$content = '<h3>Ajax out catalog menu</h3>';






//AJax вывод модального окна редактирования групп товаров
//============================================================================
	} elseif ($page == 'modalgroup') {
		$content = '<h3>Show modal group page</h3>';







//404
//=============================================================================
	} else {
		$content = '<h3>404 page</h3>';


	}

?>