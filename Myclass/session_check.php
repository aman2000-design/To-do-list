<?php
if ($_SESSION['userid'] == '' || $_SESSION['name'] == '') {
	header('location:Myclass/sessionDestroy.php');
}
?>