<?php
session_start();

require_once 'Myclass/session_check.php';
require_once 'Myclass/PDOconnection.php';
require_once 'Myclass/functions.php';
// print_r($_SESSION);
$table = "tblemployees";
$msg = '';
$isError = false;
$compid = $_SESSION['compid'];
$mode = 'Add';
$id = '';
$result['name'] = $result['email'] = $result['phone'] = $result['mobile'] = $result['website'] = $result['address'] = $result['state'] = $result['city'] = '';

if (isset($_GET['id'])) {
	$mode = "Update";
	$id = $_GET['id'];
}

if (isset($_POST['Add'])) {
	$msg = validation($_POST);

	if ($msg == 1) {

		$sql = "SELECT * FROM $table WHERE name = ? or  email = ?  and  mobile = ? and  address = ?  and  userid = ? and  compid = ? and  state = ? and  city = ?";
		$val = array();
		$val[] = $_POST['emp_name'];
		$val[] = $_POST['email'];
		$val[] = $_POST['mobile'];
		$val[] = $_POST['address'];
		$val[] = $_SESSION['userid'];
		$val[] = $compid;
		$val[] = $_POST['state'];
		$val[] = $_POST['city'];
		echo $query = doublicateEntry($sql, $val, $db);
		if ($query > 0) {
			$msg = "Dublicate Entry";
		}

	}

	if ($msg == 1) {

		$sql = "INSERT INTO $table (name, add_date, email, mobile, address, userid, compid, state, city) VALUES (?,?,?,?,?,?,?,?,?)";
		$arr = array();
		$arr[] = $_POST['emp_name'];
		$arr[] = date('Y-m-d H:i:s');
		$arr[] = $_POST['email'];
		$arr[] = $_POST['mobile'];
		$arr[] = $_POST['address'];
		$arr[] = $_SESSION['userid'];
		$arr[] = $compid;
		$arr[] = $_POST['state'];
		$arr[] = $_POST['city'];

		$query = $db->query($sql, $arr);
		if ($query == 1) {
			$msg = 'Employee added successfully';
		} else {
			$msg = "Employee can't add";
			$isError = true;

		}
	} else {
		$isError = true;
	}

}

if (isset($_POST['Update'])) {
	$msg = validation($_POST);
	if ($msg == 1) {

		$sql = "UPDATE $table SET name = ?, email = ?, mobile = ?, Address  = ?, state = ?, city = ? , update_date = ?  WHERE  id  = ?";
		$arr = array();
		$arr[] = $_POST['emp_name'];
		$arr[] = $_POST['email'];
		$arr[] = $_POST['mobile'];
		$arr[] = $_POST['address'];
		$arr[] = $_POST['state'];
		$arr[] = $_POST['city'];
		$arr[] = date('Y-m-d H:i:s');
		$arr[] = $id;

		$query = $db->query($sql, $arr);
		if ($query) {

			$msg = "Employee details Updated Successfully";
		} else {
			$msg = "Employee details can't Update";
			$isError = true;
		}
	} else {
		$isError = true;
	}
}

$sql = "SELECT * FROM $table WHERE id = ?";
$arr = array();
$arr[] = $id;

$result = $db->fetchWithId($sql, $arr);

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title><?php echo $mode; ?> Employee</title>
</head>
<body>

	            <?php require_once 'header.php'?>


	<div class="container mt-5 bg-light">
		<div class="row bg-dark text-white">
			<div class="col-md-12 text-center my-3 d-flex">
	 			<div class="col-md-11">
	 			<h1><?php echo $mode; ?> Employee</h1>
                </div>
	            <?php require_once 'logoutbtn.php'?>

			</div>
		</div>
		<form action="" method="POST" class=" mx-5 py-5" >
			<div class="col-md-6 mx-auto">
				<?php require_once 'Myclass/messagePrint.php'?>
				<div class="row">
					<div class="col-md-12">
						<label>Employee Name *</label>
						<input type="text" name="emp_name" class="form-control"  value="<?php echo $result['name'] ?>"required="This field is required">
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
						<label>Mobile *</label>
						<input type="text" name="mobile" class="form-control"  value="<?php echo $result['mobile'] ?>" >
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label>Address *</label>
						<input type="text" name="address" class="form-control" required="This field is required" value="<?php echo $result['address'] ?>" >
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
						<input type="submit" name="<?php echo $mode; ?>" value="<?php echo $mode; ?>" class="d-block mx-auto btn btn-info">
					</div>
				</div>

                 <div class="row mt-3">
						<div class="col-md-12 text-center">
							<a href="addTask.php" class="text-primary mt-2" style="font-size: 16px ; ">Add Task</a></div>
						</div>
							<div class="row mt-3">
						<div class="col-md-12 text-center">
							<a href="addEmp.php" class="text-primary mt-2" style="font-size: 16px ; ">Add Employee</a></div>
						</div>
							<div class="row mt-3">

						<div class="col-md-12 text-center">
							<a href="Emplist.php" class="text-primary mt-2" style="font-size: 16px ; ">Employees List</a></div>
						</div>
					</div>
			</div>
		</form>
	</div>



</body>
</html>