<?php
session_start();
require_once 'Myclass/session_check.php';
require_once 'Myclass/PDOconnection.php';
require_once 'Myclass/functions.php';
$table = "tblcompany";
$msg = '';
$isError = false;
$compid = $_SESSION['compid'];
if (isset($_POST['Update'])) {
	$msg = validationComp($_POST);
	if ($msg == 1) {

		$sql = "UPDATE $table SET company_name = ?, email = ?, phone = ?, mobile = ?, website = ?, userid = ?, Address  = ?, state = ?, city = ? , update_date = ?  WHERE  id  = $compid";
		$arr = array();
		$arr[] = $_POST['company_name'];
		$arr[] = $_POST['email'];
		$arr[] = $_POST['phone'];
		$arr[] = $_POST['mobile'];
		$arr[] = $_POST['website'];
		$arr[] = $_SESSION['userid'];
		$arr[] = $_POST['address'];
		$arr[] = $_POST['state'];
		$arr[] = $_POST['city'];
		$arr[] = date('Y-m-d H:i:s');
		$query = $db->query($sql, $arr);
		if ($query) {

			$msg = "Company Updated Successfully";
		} else {
			$msg = "Company can't Update";
			$isError = true;
		}
	} else {
		$isError = true;
	}
}
$sql = "SELECT * FROM $table WHERE id = ?";
$arr = array();
$arr[] = $compid;
$result = $db->fetchWithId($sql, $arr);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Company Details Page</title>
</head>
<body>
				<?php require_once 'header.php'?>


	<div class="container mt-5 bg-light">


		<div class="row bg-dark text-white">
			<div class="col-md-12 text-center my-3 d-flex">
				<div class="col-md-11">
					<h1>Company Details Form</h1>
				</div>
				<?php require_once 'logoutbtn.php'?>
			</div>
		</div>
		<form action="" method="POST" class=" mx-5 py-5" >
			<div class="col-md-6 mx-auto">
				<?php require_once 'Myclass/messagePrint.php'?>
				<div class="row">
					<div class="col-md-12">
						<label>Company Name *</label>
						<input type="text" name="company_name" class="form-control"  value="<?php echo $result['company_name'] ?>"required="This field is required">
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label>E-mail *</label>
						<input type="email" name="email" class="form-control" required="This field is required" value="<?php echo $result['email'] ?>" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Phone *</label>
						<input type="text" name="phone" class="form-control" required="This field is required" value="<?php echo $result['phone'] ?>" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Mobile *</label>
						<input type="text" name="mobile" class="form-control"  value="<?php echo $result['mobile'] ?>" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Website *</label>
						<input type="text" name="website" class="form-control"  value="<?php echo $result['website'] ?>" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Address *</label>
						<input type="text" name="address" class="form-control" required="This field is required" value="<?php echo $result['Address'] ?>" >
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>State *</label>
						<input type="text" name="state" class="form-control" required="This field is required" value="<?php echo $result['state'] ?>" >
					</div>
					<div class="col-md-6">
						<label>City *</label>
						<input type="text" name="city" class="form-control" required="This field is required" value="<?php echo $result['city'] ?>" >
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-12">
						<input type="submit" name="Update" value="Update" class="d-block mx-auto btn btn-info">
					</div>
				</div>
				<?php
if ($result['state'] != '') {
	?>
					<div class="row mt-3">
						<div class="col-md-12 text-center">
							<a href="addTask.php" class="text-primary mt-2" style="font-size: 16px ; ">Add Task</a></div>
						</div>
						<div class="row mt-3">
							<div class="col-md-12 text-center">
								<a href="addEmp.php" class="text-primary mt-2" style="font-size: 16px ; ">Add Employee</a></div>
							</div>
							<?php
}
?>
					</div>
				</form>
			</div>
		</body>
		</html>