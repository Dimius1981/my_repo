<?php
	$tpl = new Smarty; //Создание объекта Smarty

	//$tpl->caching = true; //Включим кэширование

	//$tpl->cache_lifetime = 120;

	//Передадим информацию о пользователе в шаблон
	$tpl->assign('user_info', $user_info);

	$group_products_list = Array();
	$goup_products_obj = get_group_products_by_par_id(0); //par_id = 0

	while($row = mysqli_fetch_assoc($goup_products_obj)) {
		//Есть ли подгруппа
		//print_r($row);
		$row['sub'] = Array();
		$sub_group_obj = get_group_products_by_par_id($row['id']);
		while($sub_row = mysqli_fetch_assoc($sub_group_obj)) {
			$row['sub'][] = $sub_row;
		}

		$group_products_list[] = $row;
	}

	$tpl->assign('gpl', $group_products_list);





//Главная страница
//============================================================================
	if ($page == '') {
		if ($user_info) {
			$page_title = 'Акционные товары ('.$user_info['level_name'].')';
		} else {
			$page_title = 'Акционные товары';
		}
		$tpl->assign('PageTitle', $page_title);
		$tpl->assign('Content', $content);

		$products_obj = get_sale_products();

		$products_list = Array();

		while ($row = mysqli_fetch_assoc($products_obj)) {
			//new_price = price - (price * sale_percent / 100)
			$row['new_price'] = $row['price'] - ($row['price'] *
				$row['sale_percent'] / 100);
			$products_list[] = $row;
		}


		$tpl->assign('products', $products_list);


		$tpl->display('main.tpl');






//Страница отображения продуктов
//============================================================================
   } elseif ($page == 'products') {

   	$group_info = mysqli_fetch_assoc(get_group_products_by_id($group));

   	//print_r($group_info);

		$tpl->assign('PageTitle', $group_info['name']);
		$tpl->assign('Content', $content);

		$products_list = Array();
		$products_obj = get_products_by_group_id($group);

		while ($row = mysqli_fetch_assoc($products_obj)) {
			//new_price = price - (price * sale_percent / 100)

			$row['new_price'] = $row['price'] - ($row['price'] * $row['sale_percent'] / 100);
			$products_list[] = $row;
		}

		//print_r($products_list);

		$tpl->assign('group_info', $group_info);

		$tpl->assign('products', $products_list);

		$tpl->display('main.tpl');







//Страница О магазине...
//============================================================================
	} elseif ($page == 'about') {
		$tpl->assign('PageTitle', 'О магазине...');
		$tpl->assign('Content', $content);

		$tpl->display('main.tpl');




//Страница Акции
//============================================================================
	} elseif ($page == 'act_page') {
		$tpl->assign('PageTitle', 'Акционные товары');
		$tpl->assign('Content', $content);

		$tpl->display('main.tpl');










//Страница Корзина
//============================================================================
	} elseif ($page == 'cart') {
		$tpl->assign('PageTitle', 'Корзина (0)');
		$tpl->assign('Content', $content);

		$tpl->display('main.tpl');





//404
//=============================================================================
	} else {
		$tpl->assign('PageTitle', '404');
		$tpl->assign('Content', $content);

		$tpl->display('main.tpl');


	}


?>