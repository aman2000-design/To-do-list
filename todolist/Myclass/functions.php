<?php

function validationWithcontinue($arr, $x) {
	$msg = '';

	foreach ($arr as $key => $value) {

		if ($key == $x) {
			continue;
		}

		if (trim($value) == '') {
			$msg .= ucfirst($key) . ' field is required';
		}

	}

	if (strlen($msg) > 30) {
		return "All the fields are required";
	}

	if (strlen($msg) < 30 && $msg != '') {
		return $msg;

	}

	return 1;

}

function validation($arr) {

	$msg = '';
	foreach ($arr as $key => $value) {
		if (trim($value) == '') {
			$msg .= ucfirst($key) . " field is required";
		}
	}

	if (strlen($msg) > 30) {
		return "All the fields are required";
	}

	if (strlen($msg) < 30 && $msg != '') {
		return $msg;

	}

	return 1;
}

function UserExist($table, $val, $db) {

	$sql = "SELECT * FROM $table WHERE username = ?  OR email = ? ";
	$arr = array();
	$arr[] = $val['username'];
	$arr[] = $val['email'];
	return $db->MyrowCount($sql, $arr);
}

function validationComp($arr) {

	$msg = '';

	if (trim($arr['company_name']) == '') {
		$msg .= "Company Name is required";
	}
	if (trim($arr['email']) == '') {
		$msg .= "Email is required";

	}
	if (trim($arr['phone']) == '') {
		$msg .= "Phone number is required";

	}
	if (trim($arr['address']) == '') {
		$msg .= "Address is required";

	}
	if (trim($arr['state']) == '') {
		$msg .= "State is required";

	}
	if (trim($arr['city']) == '') {
		$msg .= "City is required";

	}

	if (strlen($msg) > 30) {
		return "All the fields are required";
	}

	if (strlen($msg) < 30 && $msg != '') {
		return $msg;
	}

	return 1;

}

function doublicateEntry($sql, $arr, $db) {

	$stmt = $db->prepare($sql);

	$key = 1;
	foreach ($arr as $val => &$value) {
		$stmt->bindParam($key, $value);
	}

	$stmt->execute($arr);
	return $stmt->rowCount();

}

?>