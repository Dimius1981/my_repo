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

?>