<?php
//Подключаемя к БД
$connect = @mysqli_connect($HOST_DB, $USER_DB, $PASS_DB, $NAME_DB);

if (mysqli_connect_errno()) {
	echo 'ERROR: '.mysqli_connect_error();
	exit();
}


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


function get_products_by_group_id($group_id) {
	global $connect;

	$sql = "SELECT * FROM products WHERE group_id = $group_id ORDER BY name ASC;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}


function get_group_products_by_id($id) {
	global $connect;

	$sql = "SELECT id, name FROM group_products WHERE id = $id;";
	$result = @mysqli_query($connect, $sql);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";

		return 0;
	} else {
		return $result;
	}
}


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















// User
// ====================================

// Авторизация. Создание сессии.
function authorization($login, $pass) {
	global $connect;

	$sql = "SELECT * FROM users WHERE login = '$login' AND pass = '$pass'";
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

	$sql = "SELECT * FROM users WHERE id = $session_id;";
	$result = @mysqli_query($connect, $sql);
	$res_arr = mysqli_fetch_assoc($result);
	if (!$result) {
		echo "MySQL Error: ".mysqli_error($connect)."</br>";
		echo "SQL = \"". $sql . "\"";
	}

	return $res_arr;
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