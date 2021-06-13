<?php
session_start();
require_once 'Myclass/session_check.php';
require_once 'Myclass/PDOconnection.php';
require_once 'Myclass/functions.php';

$table = "tblemployees";
$msg = '';
$isError = false;
$compid = $_SESSION['compid'];
$dltId = '';
if (isset($_POST['delete'])) {
	$dltId = $_POST['delete'];
	$sql = "DELETE FROM $table WHERE id = ?";
	$arr = array();
	$arr[] = $dltId;
	$query = $db->query($sql, $arr);
	if ($query == 1) {
		$msg = 'Employee deleted Successfully';
	} else {
		$msg = "Employee can't delete";
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
	<title>List Employee</title>
</head>
<body>

				<?php require_once 'header.php'?>

	<div class="container ">

		<div class="row bg-dark text-white mt-5">
			<div class="col-md-12 text-center my-3 d-flex">
				<div class="col-md-11">
					<h1>List of Employees</h1>
				</div>
				<?php require_once 'header.php'?>
			</div>
		</div>
		<table class="table table-bordered table-striped">

			<tr>
				<th>Id</th>
				<th>Employee name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Address</th>
				<th>Actions</th>
			</tr>
			<?php
$sql = "SELECT * FROM tblemployees WHERE compid = ?";
$arr = array();
$arr[] = $compid;
$rows = $query = $db->fetchWithRowname($sql, $arr);
foreach ($rows as $row) {
	?>
				<tr>
					<td><?php echo $row['id'] ?></td>
					<td><?php echo $row['name'] ?></td>
					<td><?php echo $row['email'] ?></td>
					<td><?php echo $row['mobile'] ?></td>
					<td><?php echo $row['address'] ?></td>
					<td>
						<div class="d-flex" >
							<a href="addEmp.php?id=<?php echo $row['id'] ?>" name = 'edit' value='<?php echo $row['id'] ?>' class="  btn btn-primary">Edit</a>
							<form action="" method = 'POST'>
								<button name='delete' value="<?php echo $row['id'] ?>" class="btn btn-danger ml-3">Delete</button>
							</form>
						</div>
					</td>
				</tr>
				<?php
}
?>
		</table>
	</div>
</body>
</html>