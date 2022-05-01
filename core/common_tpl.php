<?php
	$tpl = new Smarty; //Создание объекта Smarty

	//$tpl->caching = true; //Включим кэширование

	//$tpl->cache_lifetime = 120;

	//Передадим информацию о пользователе в шаблон
	$tpl->assign('user_info', $user_info);

	$group_products_list = Array();
	$goup_products_obj = get_group_products_by_par_id(0); //par_id = 0

	while($row = mysqli_fetch_assoc($goup_products_obj)) {
		$col_pro_obj = get_col_products_by_group_id($row['id']);
		$col_pro_arr = mysqli_fetch_assoc($col_pro_obj);
		//Есть ли подгруппа
		//print_r($row);
		$row['sub'] = Array();

		//Запишем количество товаров в группе верхнего уровня
		$row_count = $col_pro_arr['count(id)'];
		$sub_group_obj = get_group_products_by_par_id($row['id']);

		while($sub_row = mysqli_fetch_assoc($sub_group_obj)) {
			$col_pro_obj = get_col_products_by_group_id($sub_row['id']);
			$col_pro_arr = mysqli_fetch_assoc($col_pro_obj);
			$sub_row['col'] = $col_pro_arr['count(id)'];
			//Суммируем количество товаров в подгруппах
			$row_count = $row_count + $col_pro_arr['count(id)'];
			$row['sub'][] = $sub_row;
		}

		$row['col'] = $row_count;
		$group_products_list[] = $row;
	}

	$tpl->assign('gpl', $group_products_list);


	//Передадим инфу о странице и о группе товаров
	$tpl->assign('page',$page);
	$tpl->assign('group',$group);





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


		if (!$tp) {
			$tpl->display('main.tpl');
		} else {
			$tpl->display('content/'.$tp);
		}







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

		//print_r($tp);

		if (!$tp) {
			$tpl->display('main.tpl');
		} else {
			$tpl->display('content/'.$tp);
		}







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





//============================================================================
// Группы товаров
// ===========================================================================
// JSon GET группа товаров по id
//============================================================================
	} elseif ($page == 'jgroup') {
		$group_obj = get_group_products_by_id($group);
		$group_arr = mysqli_fetch_assoc($group_obj);

		//print_r($group_arr);

		echo json_encode($group_arr);





//Запрос на добавление/изменение групп товаров
//============================================================================
	} elseif ($page == 'groupsubmit') {
		//print_r($_POST);
		if (isset($_POST['group_id'])) {
			$group_id = $_POST['group_id'];
		} else {
			$group_id = 0;
		}
		if (isset($_POST['group-par-id'])) {
			$group_par_id = $_POST['group-par-id'];
		} else {
			$group_par_id = 0;
		}
		if (isset($_POST['group-name'])) {
			$group_name = $_POST['group-name'];
		} else {
			$group_name = '';
		}
		if (isset($_POST['group-description'])) {
			$group_description = $_POST['group-description'];
		} else {
			$group_description = '';
		}
		if (isset($_POST['group-file'])) {
			$group_file = $_POST['group-file'];
		} else {
			$group_file = '';
		}

		if ($group_id > 0) {
			//Необходимо редактировать данную группу
			update_group_products($group_id, $group_par_id, $group_name, $group_description, $group_file);
		} else {
			//Добавим новую группу
			add_group_products($group_par_id, $group_name, $group_description, $group_file);
		}





//Запрос на удаление группы товаров
//============================================================================
	} elseif ($page == 'groupdelete') {
		delete_group_products($group);




//AJAX вывод каталога меню
//============================================================================
	} elseif ($page == 'catalog_view') {
		$tpl->display('aside.tpl');





//AJax вывод модального окна редактирования групп товаров
//============================================================================
	} elseif ($page == 'modalgroup') {
		$tpl->display('edit_group.tpl');














//============================================================================
// Товары
// ===========================================================================
// JSon GET товара по id
//============================================================================
	} elseif ($page == 'jproduct') {
		$prod_obj = get_product_by_id($id);
		$prod_arr = mysqli_fetch_assoc($prod_obj);
		echo json_encode($prod_arr);




//Запрос на добавление/изменение товаров
//============================================================================
	} elseif ($page == 'productsubmit') {
		print_r($_POST);

/*
_POST Array
Array
(
     [product-name] => Товар 1 из группы 1-1
     [product-group-id] => 5
     [product-description] => Это описание товара 1 из группы 1-1
     [product-price] => 1000
     [product-sale] => on
     [product-percent] => 20
     [product-file] => ./images/group05\phone01.png
     [product_id] => 1
)
 */
		if (isset($_POST['product_id'])) {
			$product_id = $_POST['product_id'];
		} else {
			$product_id = 0;
		}
		if (isset($_POST['product-group-id'])) {
			$product_group_id = $_POST['product-group-id'];
		} else {
			$product_group_id = 0;
		}
		if (isset($_POST['product-name'])) {
			$product_name = $_POST['product-name'];
		} else {
			$product_name = '';
		}
		if (isset($_POST['product-description'])) {
			$product_description = $_POST['product-description'];
		} else {
			$product_description = '';
		}
		if (isset($_POST['product-file'])) {
			$product_file = $_POST['product-file'];
		} else {
			$product_file = '';
		}
		if (isset($_POST['product-price'])) {
			$product_price = $_POST['product-price'];
		} else {
			$product_price = 0;
		}
		if (isset($_POST['product-sale'])) {
			$product_sale = 1;
		} else {
			$product_sale = 0;
		}
		if (isset($_POST['product-percent'])) {
			$product_percent = $_POST['product-percent'];
			if ($product_percent == '') {
				$product_percent = 0;
			}
		} else {
			$product_percent = 0;
		}

		if ($product_id > 0) {
			//Необходимо редактировать данную группу
			update_product($product_id, $product_group_id, $product_name, $product_description, $product_file, $product_price, $product_sale, $product_percent);
		} else {
			//Добавим новый товар
			add_new_product($product_group_id, $product_name, $product_description, $product_file, $product_price, $product_sale, $product_percent);
		}


//Запрос на удаление товара
//============================================================================
	} elseif ($page == 'productdelete') {
		delete_product($id);










//404
//=============================================================================
	} else {
		$tpl->assign('PageTitle', '404');
		$tpl->assign('Content', $content);

		$tpl->display('main.tpl');


	}


?>