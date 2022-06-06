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

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		$id = 0;
	}

	if (isset($_GET['tp'])) {
		$tp = $_GET['tp'];
	} else {
		$tp = '';
	}

	if (isset($_GET['start'])) {
		$start = $_GET['start'];
	} else {
		$start = 0;
	}

	if (isset($_GET['br'])) {
		$br = $_GET['br'];
	} else {
		$br = 0;
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
	} elseif (($page == 'cart') and ($user_info)) {
		$content = "{include file='content/carts_view.tpl'}";




//добавление товаров в корзину
//============================================================================
	} elseif ($page == 'addcart') {
		$content = "<h3>Add to cart page</h3>";



//Количество товаров в корзине JSon
//============================================================================
	} elseif ($page == 'colcart') {
		$content = "<h3>JSon col cart page</h3>";



//Обновление товара в корзине
//============================================================================
	} elseif ($page == 'updcart') {
		$content = "<h3>Get update cart page</h3>";



//Удаление товара из корзины
//============================================================================
	} elseif ($page == 'cartdelete') {
		$content = "<h3>Cart delete page</h3>";


//Обновление страницы корзины через Ajax
//============================================================================
	} elseif ($page == 'cart_view') {
		$content = "<h3>Ajax update cart page</h3>";






//============================================================================
// Группы товаров
// ===========================================================================
// JSon GET группа товаров по id
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











//============================================================================
// Товары
// ===========================================================================
// JSon GET товара по id
//============================================================================
	} elseif ($page == 'jproduct') {
		$content = '<h3>JSon product by id</h3>';

//Запрос на добавление/изменение товаров
//============================================================================
	} elseif ($page == 'productsubmit') {
		$content = '<h3>Product submit page</h3>';

//AJAX вывод списка товаров
//============================================================================
	} elseif ($page == 'products_view') {
		$content = '<h3>Ajax out products view</h3>';

//Запрос на удаление товара
//============================================================================
	} elseif ($page == 'productdelete') {
		$content = '<h3>Product delete page</h3>';


//Страница товара
//============================================================================
	} elseif ($page == 'prod') {
		$content = "{include file='content/prod_info.tpl'}";






//Оформление заказа
//============================================================================
	} elseif (($page == 'addorder') and ($user_info)) {
		$content = '<div class="row p-3">
			<div class="col text-center">
				<h3>Поздравляем!</h3>
				<p>Ваш заказ под номером {$order_id} успешно создан!</p>
			</div>
		</div>
		{include file="content/order_view.tpl"}';





//Страница мои заказы (пользователя - не админа)
//============================================================================
	} elseif (($page == 'myorders') and ($user_info)) {
		$content = "{include file='content/myorders_view.tpl'}";




//Страница мой заказ (пользователя - не админа)
//============================================================================
	} elseif (($page == 'orderview') and ($user_info)) {
		$content = "{include file='content/order_view.tpl'}";




//Страница все заказы (только для админа)
//============================================================================
	} elseif (($page == 'allorders') and ($user_info['level_id'] == 1)) {
		$content = "{include file='content/allorders_view.tpl'}";



//Обновление статуса заказа
//============================================================================
	} elseif (($page == 'updordst') and ($user_info['level_id'] == 1)) {
		$content = "Update Order Status";






//404
//=============================================================================
	} else {
		$content = '<h3>404 page</h3>';
	}

?>