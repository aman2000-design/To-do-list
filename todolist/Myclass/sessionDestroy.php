<?php 

session_start();

unset($_SESSION['userid'] );
unset($_SESSION['name'] );
unset($_SESSION['compid'] );
session_destroy();

header('location:../login.php');

  ?>