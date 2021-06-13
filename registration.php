<?php
require_once 'Myclass/PDOconnection.php';
require_once 'Myclass/functions.php';
$table = "tbluser";
$msg = '';
$isError = false;
$lastInsertId = "PersonalUser";
if (isset($_POST['submit'])) {
	$msg = validation($_POST);
	if ($msg == 1) {
		$rows = UserExist($table, $_POST, $db);
		if ($rows > 0) {
			$msg = "This email or username is alredy in use";
			$isError = true;
		}
		if ($msg == 1) {
			if (trim($_POST['password']) != trim($_POST['Retypepassword'])) {
				$msg = "Passwords not match";
				$isError = true;
			}
		}
		if (isset($_GET['msg'])) {
			$sql1 = "INSERT INTO tblcompany (company_name,add_date) VALUES (?,?)";
			$val = array();
			$val[] = $_POST['company'];
			$val[] = date("Y-m-d H:i:s");
			$db->query($sql1, $val);
			$lastInsertId = $db->lastInsertId();
		}
		if ($msg == 1) {
			$sql = "INSERT INTO $table (name,username,password,email,mobile,add_date,address,state,city,compid)
			VALUES (?,?,?,?,?,?,?,?,?,?)";
			$arr = array();
			$arr[] = $_POST['name'];
			$arr[] = $_POST['username'];
			$arr[] = md5($_POST['password']);
			$arr[] = $_POST['email'];
			$arr[] = $_POST['mobile'];
			$arr[] = date('Y-m-d H:i:s');
			$arr[] = $_POST['address'];
			$arr[] = $_POST['state'];
			$arr[] = $_POST['city'];
			$arr[] = $lastInsertId;
			echo $query = $db->query($sql, $arr);
			if ($query) {

				$msg = "User Added Successfully";
			} else {
				$msg = "User can't Add";
				$isError = true;
			}
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
	<title>Registration Page</title>
</head>
<body class="bodybg">

	<div class="container mt-5 bg-light">
		<div class="row bg-dark text-white">
			<div class="col-md-12 text-center my-3">
				<h1>Registration Form</h1>
			</div>
		</div>


		<form action="" method="POST" class=" mx-5 py-5" >
			<div class="col-md-6 mx-auto">
				<?php require_once 'Myclass/messagePrint.php'?>
				<div class="row">
					<div class="col-md-6">
						<label>Name *</label>
						<input type="text" name="name" class="form-control" required="This field is required">
					</div>
					<div class="col-md-6">
						<label>Username *</label>
						<input type="text" name="username" class="form-control" required="This field is required">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Password *</label>
						<input type="password" name="password" class="form-control" required="This field is required">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Retype-Password *</label>
						<input type="password" name="Retypepassword" class="form-control" required="This field is required">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>E-mail *</label>
						<input type="email" name="email" class="form-control" required="This field is required" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Mobile *</label>
						<input type="text" name="mobile" class="form-control" required="This field is required" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Address *</label>
						<input type="text" name="address" class="form-control" required="This field is required" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>State *</label>
						<input type="text" name="state" class="form-control" required="This field is required" >
					</div>
					<div class="col-md-6">
						<label>City *</label>
						<input type="text" name="city" class="form-control" required="This field is required" >
					</div>
				</div>

				<?php if (isset($_GET['msg'])) {?>
				<div class="row">

				<div class="col-md-12">
						<label>Company name *</label>
						<input type="text" name="company" class="form-control" required="This field is required" >
					</div>
				</div>
                 <?php }?>
				<div class="row mt-3">
					<div class="col-md-12">
						<input type="submit" name="submit" class="d-block mx-auto btn btn-info">
					</div>
				</div>
<?php if (!isset($_GET['msg'])) {?>


				<div class="col-md-12 text-center mt-3">
							<a href="registration.php?msg=company" class="text-primary mt-2" style="font-size: 16px ; ">Click here for Company Registration</a></div>
						</div>


				<?php }
if ($msg == "User Added Successfully") {
	?>
					<div class="row mt-3">
						<div class="col-md-12 text-center">
							<a href="login.php<?php if (isset($_GET['msg'])) {echo '?msg=' . $_GET['msg'];}?>" class="text-primary mt-2" style="font-size: 16px ; ">Click here for Login</a></div>
						</div>
						<?php
}
?>
				</div>
			</form>
		</div>
	</body>
	</html>