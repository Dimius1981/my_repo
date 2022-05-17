<?php
//Подключаемя к БД
$connect = @mysqli_connect($HOST_DB, $USER_DB, $PASS_DB, $NAME_DB);

if (mysqli_connect_errno()) {
	echo 'ERROR: '.mysqli_connect_error();
	exit();
}




//Функция вернет группы продуктов по указанной родительской группе
function get_group_products_by_par_id($par_id) {
	global $connect;

	$sql = "SELECT * FROM group_products WHERE par_id = $par_id ORDER BY name ASC;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}



//Функция вернет продукты по указанной группе
function get_products_by_group_id($group_id, $start) {
	global $connect;
	global $MAX_PROD_PAGE;

	$sql = "SELECT * FROM products WHERE group_id = $group_id ORDER BY name ASC LIMIT $start, $MAX_PROD_PAGE;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}



//Функция возвращает количество товаров в группе
function get_col_products_by_group_id($group_id) {
	global $connect;

	$sql = "SELECT count(id) FROM products WHERE group_id = $group_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}


//Функция вернет группу по ее id
function get_group_products_by_id($id) {
	global $connect;

	$sql = "SELECT * FROM group_products WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}



//Функция вернет продукты со скидкой по всем группам
function get_sale_products() {
	global $connect;

	$sql = "SELECT * FROM products WHERE sale = 1 ORDER BY name ASC;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}







// Группы товаров
// ============================================================================
//Функция добавит новую группу товаров
function add_group_products($par_id, $name, $description, $image) {
	global $connect;

	$sql = "INSERT INTO group_products (par_id, name, description, image) VALUES ($par_id, '$name', '$description', '$image');";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}



//Функция обновляет запись группы с указанным id
function update_group_products($id, $par_id, $name, $description, $image) {
	global $connect;

	$sql = "UPDATE group_products SET par_id = $par_id, name = '$name', description = '$description', image = '$image' WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}



//Функция удаляет запись группы с указанным id
function delete_group_products($id) {
	global $connect;

	$sql = "DELETE FROM group_products WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}















// Товары
// ==============================================================
//Функция вернет товар по id
function get_product_by_id($id) {
	global $connect;

	$sql = "SELECT * FROM products WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}





//Функция добавит новый товар
function add_new_product($group_id, $name, $description, $image,
						 $price, $sale, $sale_percent) {
	global $connect;

	$sql = "INSERT INTO products (group_id, name, price, description, image,
                                  sale, sale_percent) VALUES ($group_id, '$name',
                                  $price, '$description', '$image', $sale,
                                  sale_percent);";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}




//Функция обновляет запись товара с указанным id
function update_product($id, $group_id, $name, $description, $image,
						$price, $sale, $sale_percent) {
	global $connect;

	$sql = "UPDATE products SET group_id = $group_id, name = '$name', price = $price, description = '$description', image = '$image', sale = $sale, sale_percent = $sale_percent WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}




//Функция удаляет запись товара с указанным id
function delete_product($id) {
	global $connect;

	$sql = "DELETE FROM products WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}












//Корзина
//=========================================================
//Функция вернет список товаров в корзине пользователя
function get_products_from_cart_by_user_id($user_id, $start) {
	global $connect;
	global $MAX_PROD_PAGE;

	$sql = "SELECT carts.*, products.name, products.description, products.price, products.image, products.sale, products.sale_percent FROM carts INNER JOIN products ON carts.product_id = products.id
WHERE carts.user_id = $user_id LIMIT $start, $MAX_PROD_PAGE;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}



//Функция возвращает количество товаров в корзине
function get_col_products_from_cart($user_id) {
	global $connect;

	$sql = "SELECT count(id) FROM carts WHERE user_id = $user_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}


//Функция добавит товар в корзину
function add_cart_product($user_id, $prod_id, $col) {
	global $connect;

	$sql = "INSERT INTO carts (user_id, product_id, col) VALUES ($user_id, $prod_id,
                                  $col);";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}











// User
// ====================================

// Авторизация. Создание сессии.
function authorization($login, $pass) {
	global $connect;

	$str_pass = sha1($pass);
	//print_r($str_pass);

	$sql = "SELECT * FROM users WHERE login = '$login' AND pass = '$str_pass'";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	} else {
		$res_arr = mysqli_fetch_assoc($result);
		$_SESSION['id'] = $res_arr['id'];

		//Обновим время входа только что авторизованного пользователя
		usertimeupdate($res_arr['id']);
	}
}


// Пользователь
function userinfo($session_id) {
	global $connect;

	$sql = "SELECT users.*, user_levels.name as level_name FROM users INNER JOIN user_levels ON user_levels.id = users.level_id WHERE users.id = $session_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}

	return mysqli_fetch_assoc($result);
}

//Обновим время входа
function usertimeupdate($user_id) {
	global $connect;

	$sql = "UPDATE users SET date_login = NOW() WHERE id = ".$user_id;
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}



?>