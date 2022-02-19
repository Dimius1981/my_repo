<?php
	$tpl = new Smarty; //Создание объекта Smarty

	//$tpl->caching = true; //Включим кэширование

	//$tpl->cache_lifetime = 120;




	$name = 'Hello Smarty!'; //Создали переменную name

	$tpl->assign('name1', $name); //Передали переменную в шаблон


	//Создадим массив
	$arr1 = array('Ivanov', 'Petrov', 'Sidorov');

	//Передадим массив в шаблон
	$tpl->assign('arr1', $arr1);


	//Передаем массив в шаблон
	$tpl->assign('arr2', array(
		'Block 1' => 'Ivanov',
		'Block 2' => 'Petrov',
		'Block 3' => 'Sidorov',
		'Block 4' => 'VinniPuh' 
	));


	//Создадим двумерный массив

	$data = array();

	for ($i=0; $i<10; $i++) {
		$data[] = array(
			'Num'  => $i,
			'Name' => 'Name ' . ($i + 1),
			'Value'=> ($i+1) * 100
		);
	}

	//print_r($data);


	//Передадим массив в шаблон
	$tpl->assign('data', $data);


	//Возьмем переменную $TITLE из файла config.php
	$tpl->assign('TITLE', $TITLE);


	$tpl->display('main.tpl');  //Выведем шаблон main.tpl на экран
?>