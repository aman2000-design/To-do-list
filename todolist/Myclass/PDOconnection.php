
<?php 

require_once 'Myclass/MyPDO.php';


$host = "localhost";
$dbname = "todolist";
$user = "root";
$pass =  '';


$db = new MyPDO("mysql:host=$host;dbname=$dbname",$user,$pass);


 ?>