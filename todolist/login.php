<?php
require_once 'Myclass/PDOconnection.php';
require_once 'Myclass/functions.php';
$table = "tbluser";
$msg = '';
$isError = false;
if (isset($_POST['submit'])) {
	$msg = validation($_POST);
	if ($msg == 1) {
		$usernameOrEmail = $_POST['usernameOrEmail'];
		$password = md5($_POST['password']);
		$sql = "SELECT * FROM $table WHERE  email = ? AND password = ? or username = ? AND password = ?";
		$arr = array();
		$arr[] = $usernameOrEmail;
		$arr[] = $password;
		$arr[] = $usernameOrEmail;
		$arr[] = $password;
		$rows = $db->fetchWithId($sql, $arr);
		if (count($rows) > 0 && is_array($rows)) {
			session_start();
			$_SESSION['userid'] = $rows['id'];
			$_SESSION['name'] = $rows['name'];
			$_SESSION['compid'] = $rows['compid'];
			if (is_numeric($_SESSION['compid'])) {
				header('location:companyDetails.php?msg=comp');
			} else {
				header('location:addTask.php');
			}
		} else {
			$msg = "Incorrect Username or Password";
			$isError = true;
		}
	} else {
		$isError = true;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>login Page</title>
</head>
<body class="bodybg">

	<div class="container mt-5 bg-light">
		<div class="row bg-dark text-white">
			<div class="col-md-12 text-center my-3">
				<h1>Login Form</h1>
			</div>
		</div>
		<form action="" method="POST" class=" mx-5 py-5" >
			<div class="col-md-6 mx-auto">
				<?php require_once 'Myclass/messagePrint.php'?>
				<div class="row">
					<div class="col-md-12">
						<label>Username or Email*</label>
						<input type="text" name="usernameOrEmail" class="form-control" required="This field is required">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Password *</label>
						<input type="password" name="password" class="form-control" required="This field is required">
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-md-12 d-flex mb-5">
						<div class="col-md-6">
							<a href="registration.php<?php if (isset($_GET['msg'])) {echo '?msg=' . $_GET['msg'];}?>" class="text-primary mt-2 d-block" style="font-size: 16px ; ">Click here for Registration</a>
						</div>
						<div class="col-md-6 float-right">
							<input type="submit" name="submit" class=" btn btn-info float-right ">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>
</html>