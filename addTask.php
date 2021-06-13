<?php
session_start();

require_once 'Myclass/session_check.php';
require_once 'Myclass/PDOconnection.php';
require_once 'Myclass/functions.php';

$table = "tbltasks";
$msg = '';
$isError = false;
$compid = $_SESSION['compid'];
$heading = 'Add';
$selectEmpId = 'PersonalUser';

$result['task_name'] = $result['done_by_date'] = $result['work_for_empid'] = '';

if (isset($_GET['id'])) {
	$heading = "Update";
	$id = $_GET['id'];
}

if (isset($_POST['Add'])) {
	$msg = validation($_POST);
	if ($msg == 1) {

		if (is_numeric($compid)) {
			$selectEmpId = $_POST['selectEmp'];
			$compid = $_SESSION['compid'];

		}

		$sql = "INSERT INTO $table (task_name, add_date, done_by_date, userid, work_for_empid, compid) VALUES (?,?,?,?,?,?)";
		$arr = array();
		$arr[] = $_POST['task_name'];
		$arr[] = date("Y-m-d H:i:s");
		$arr[] = $_POST['donebydate'];
		$arr[] = $_SESSION['userid'];
		$arr[] = $selectEmpId;
		$arr[] = $_SESSION['compid'];

		$query = $db->query($sql, $arr);
		if ($query) {

			$msg = "Task Added Successfully";
		} else {
			$msg = "Task can't Added";
			$isError = true;
		}
	} else {
		$isError = true;
	}
}

if (isset($_POST['Update'])) {
	$msg = validation($_POST);
	if ($msg == 1) {

		if (is_numeric($compid)) {

			$sql = "UPDATE $table SET task_name = ?, done_by_date = ?, work_for_empid = ?, update_date = ? WHERE  id  = ?";
			$arr = array();
			$arr[] = $_POST['task_name'];
			$arr[] = $_POST['donebydate'];
			$arr[] = $_POST['selectEmp'];
			$arr[] = date('Y-m-d H:i:s');
			$arr[] = $id;
		} else {

			$sql = "UPDATE $table SET task_name = ?, done_by_date = ?, update_date = ? WHERE  id  = ?";
			$arr = array();
			$arr[] = $_POST['task_name'];
			$arr[] = $_POST['donebydate'];
			$arr[] = date('Y-m-d H:i:s');
			$arr[] = $id;
		}

		$query = $db->query($sql, $arr);
		if ($query) {

			$msg = "Tadk Updated Successfully";
		} else {
			$msg = "Task can't Update";
			$isError = true;
		}
	} else {
		$isError = true;
	}
}

if (isset($_GET['id'])) {

	$sql = "SELECT * FROM $table WHERE id = ?";
	$arr = array();
	$arr[] = $id;
	$result = $db->fetchWithId($sql, $arr);

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<title> <?php echo $heading; ?> task</title>
</head>
<body>



<?php require_once 'header.php'?>


<div class="container mt-5 bg-light">

<div class="row bg-dark text-white">
<div class="col-md-12 text-center my-3 d-flex">
<div class="col-md-11">
<h1> <?php echo $heading; ?> task</h1>
</div>
<?php require_once 'logoutbtn.php'?>

</div>
</div>
<form action="" method="POST" class=" mx-5 py-5" >
<div class="col-md-6 mx-auto">
<?php require_once 'Myclass/messagePrint.php'?>
<div class="row">
<div class="col-md-12">
<label>Task Name *</label>
<input type="text" name="task_name" class="form-control"   value="<?php echo $result['task_name'] ?>" required="This field is required">
</div>
</div>
<div class="row">

<div class="col-md-<?php if (is_numeric($compid)) {echo '6';} else {echo '12';}?>">
<label>Done by date*</label>
<input type="date" name="donebydate" class="form-control"  value="<?php echo $result['done_by_date'] ?>" required="This field is required" >
</div>

<?php if (is_numeric($compid)) {
	?>

	<div class="col-md-6">
	<label>Select Employee*</label>
	<select name="selectEmp" id="" class="form-control">
	<option>Select Employee</option>
	<?php $sql = "SELECT * FROM tblemployees WHERE compid = ?";
	$arr = array();
	$arr[] = $compid;
	$rows = $db->fetchWithRowname($sql, $arr);
	foreach ($rows as $row) {

		?>
		<option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == $result['work_for_empid']) {echo 'Selected';}?>><?php echo $row['name'] ?></option>
		<?php }?>

		<option value="self">Self</option>
		</select>

		</div>
		<?php }?>
		</div>

		<div class="row mt-3 mb-5 text-center">
		<div class="col-md-12 ">
		<input type="submit" name="<?php echo $heading ?>" value="<?php echo $heading ?>" class="btn btn-info">
		</div>
		<div class="col-md-12 mt-3">
		<a href="list_of_Tasks.php" class="text-primary " style="font-size: 16px ; ">List of Tasks</a>
		</div>

		</div>
		</div>

		</form>
		</div>
		</div>

		</body>
		</html>