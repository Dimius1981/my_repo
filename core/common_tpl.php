<?php
	$tpl = new Smarty; //Создание объекта Smarty

	//$tpl->caching = true; //Включим кэширование

	//$tpl->cache_lifetime = 120;


//Главная страница
//============================================================================
	if ($page == '') {
		$tpl->assign('PageTitle', 'Акционные товары');
		$tpl->assign('Content', $content);

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