<?php

class MyPDO extends PDO

{
	
	var  $lastStatment = '';
	
	var $lastInsertId = '';
	
	function query($sql,$arr){
		
		$stmt = $this->prepare($sql);
		


		$this->lastStatment = $stmt;
		
		$key = 1;
		
		foreach ($arr as $val => &$value) {
			
			$stmt->bindParam($key,$value);
			
// echo $key .'=>' .$value."<br>";
			
			$key++;
			
		}
		


		return $stmt->execute();
		
	}
	
	function selectAll($sql){
		




		$stmt = $this->prepare($sql);
		
		$this->lastStatment = $stmt;
		
		$stmt->execute();
		
		return $stmt->fetchAll();
		
	}
	
	function MyrowCount($sql,$arr){
		


		$stmt = $this->prepare($sql);
		


		$this->lastStatment = $stmt;
		
		$key = 1;
		
		foreach ($arr as $val => &$value) {
			
			$stmt->bindParam($key,$value);
			
		}
		
		$stmt->execute($arr);
		
		return $stmt->rowCount();
		
	}
	
	function fetchWithId($sql,$arr){
		


		$stmt = $this->prepare($sql);
		


		$this->lastStatment = $stmt;
		
		$key = 1;
		
		foreach ($arr as $val => &$value) {
			
			$stmt->bindParam($key,$value);
			
		}
		
		$stmt->execute($arr);
		
		return $stmt->fetch();
		
	}
	
	function fetchWithRowname($sql,$arr){
		


		$stmt = $this->prepare($sql);
		


		$this->lastStatment = $stmt;
		
		$key = 1;
		
		foreach ($arr as $val => &$value) {
			
			$stmt->bindParam($key,$value);
			
		}
		
		$stmt->execute($arr);
		
		return $stmt->fetchall();
		
	}
	
}

?>
