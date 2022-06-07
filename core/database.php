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



//Функция вернет товар из корзины по id товара
function get_product_from_cart($user_id, $prod_id) {
	global $connect;

	$sql = "SELECT * FROM carts WHERE user_id = $user_id AND product_id = $prod_id;";
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




//Функция обновляет запись корзины товара с указанным id
function update_cart($id, $user_id, $prod_id, $col) {
	global $connect;

	$sql = "UPDATE carts SET user_id = $user_id, product_id = $prod_id, col = $col WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}


//Функция удаляет запись товара с корзины по id
function delete_prod_from_cart($id) {
	global $connect;

	$sql = "DELETE FROM carts WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}






















//Функция добавит новый заказ
function add_order($user_id) {
	global $connect;

	$sql = "INSERT INTO orders (user_id, date_create, sum_order, status) VALUES ($user_id, NOW(), 0, 1);";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
		return 0;
	} else {
		return mysqli_insert_id($connect);
	}
}






//Функция обновляет запись заказа с указанным id
function update_order($id, $sum_order, $status) {
	global $connect;

	$sql = "UPDATE orders SET sum_order = $sum_order, status = $status
		WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}







//Функция обновляет запись заказа с указанным id
function update_order_status($id, $status) {
	global $connect;

	$sql = "UPDATE orders SET status = $status
		WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}







//Функция вернет список заказов пользователя
function get_my_orders($user_id) {
	global $connect;

	$sql = "SELECT orders.*, order_status.name FROM orders
	INNER JOIN order_status ON orders.status = order_status.id
	WHERE user_id = $user_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}












//Функция вернет список товаров в корзине пользователя
function get_products_from_my_order($order_id, $start) {
	global $connect;
	global $MAX_PROD_PAGE;

	$sql = "SELECT order_items.*, products.name, products.description, products.image FROM order_items
			INNER JOIN products ON order_items.product_id = products.id
			WHERE order_items.order_id = $order_id
			LIMIT $start, $MAX_PROD_PAGE;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}













//Функция добавит товар к заказу
function add_order_item($order_id, $product_id, $price, $col) {
	global $connect;

	$sql = "INSERT INTO order_items (order_id, product_id, price, col) VALUES ($order_id, $product_id, $price, $col);";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}









//Функция вернет список всех заказов
function get_all_orders($start) {
	global $connect;
	global $MAX_PROD_PAGE;

	$sql = "SELECT orders.*, order_status.name AS status_name,
	users.name AS user_name FROM orders
	INNER JOIN order_status ON orders.status = order_status.id
	INNER JOIN users ON orders.user_id = users.id
	LIMIT $start, $MAX_PROD_PAGE;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}








//Функция вернет список статусов заказов
function get_list_order_status() {
	global $connect;

	$sql = "SELECT * FROM order_status ORDER BY name ASC;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
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
		if ($res_arr['enabled']) {
			$_SESSION['id'] = $res_arr['id'];

			//Обновим время входа только что авторизованного пользователя
			usertimeupdate($res_arr['id']);
		}
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




// Список пользователей
function userlist() {
	global $connect;

	$sql = "SELECT users.*, user_levels.name as level_name FROM users INNER JOIN user_levels ON user_levels.id = users.level_id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
		return 0;
	} else {
		return $result;
	}
}





// Список уровней доступа
function userlevellist() {
	global $connect;

	$sql = "SELECT * FROM user_levels;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
		return 0;
	} else {
		return $result;
	}
}




//Функция добавит запись нового пользователя
function add_new_user($level_id, $name, $login, $pass, $email, $enabled) {
	global $connect;

	$sql = "INSERT INTO users (level_id, name, login, pass, email, enabled) VALUES ($level_id, '$name', '$login', '$pass', '$email', $enabled);";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}





//Обновим запись пользователя
function update_user_info($user_id, $level_id, $name, $login, $pass, $email, $enabled) {
	global $connect;

	$sql = "UPDATE users SET level_id = $level_id, name = '$name',
		login = '$login', pass = '$pass', email = '$email', enabled = $enabled
		WHERE id = ".$user_id;
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}
}



?>