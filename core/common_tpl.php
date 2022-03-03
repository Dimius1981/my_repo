<?php
	$tpl = new Smarty; //Создание объекта Smarty

	//$tpl->caching = true; //Включим кэширование

	//$tpl->cache_lifetime = 120;


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
		$tpl->assign('PageTitle', 'Акционные товары');
		$tpl->assign('Content', $content);

		$tpl->display('main.tpl');






//Страница О магазине...
//============================================================================
   } elseif ($page = 'products') {




		$tpl->assign('PageTitle', 'Подгруппа товаров');
		$tpl->assign('Content', $content);

		$products_list = Array();
		$products_obj = get_products_by_group_id($group);

		while ($row = mysqli_fetch_assoc($products_obj)) {
			$products_list[] = $row;
		}

		//print_r($products_list);

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