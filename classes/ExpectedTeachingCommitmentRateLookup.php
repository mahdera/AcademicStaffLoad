<?php
	include_once('DBConnection.php');
	class ExpectedTeachingCommitmentRateLookup{
		private $id;
		private $percentage;
		private $expectedHour;
		
		public function ExpectedTeachingCommitmentRateLookup($percentage,$expectedHour){
			$this->percentage = $percentage;
			$this->expectedHour = $expectedHour;
		}
		
		public function setPercentage($percentage){
			$this->percentage = $percentage;
		}
		
		public function getPercentage(){
			return $this->percentage;
		}
		
		public function setExpectedHour($expectedHour){
			$this->expectedHour = $expectedHour;
		}
		
		public function getExpectedHour(){
			return $this->expectedHour;
		}
		
		public function addExpectedTeachingCommitmentRateLookup(){
			try{
				$query = "INSERT INTO tblExpectedTeachingCommitmentRateLookup VALUES(0,'$this->percentage',$this->expectedHour)";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteExpectedTeachingCommitmentRateLookup($id){
			try{
				$query = "DELETE FROM tblExpectedTeachingCommitmentRateLookup WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateExpectedTeachingCommitmentRateLookup($id,$percentage,$expectedHour){
			try{
				$query = "UPDATE tblExpectedTeachingCommitmentRateLookup SET percentage = '$percentage', expected_hour = $expectedHour WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllExpectedTeachingCommitmentRateLookups(){
			try{
				$query = "SELECT * FROM tblExpectedTeachingCommitmentRateLookup";
				//print($query);
				$result = DBConnection::executeQuery($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getExpectedTeachingCommitmentRateLookup($id){
			try{
				$query = "SELECT * FROM tblExpectedTeachingCommitmentRateLookup WHERE id = $id";
				//print($query);
				$result = DBConnection::executeQuery($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function get100PercentExpectedTeachingCommitmentRateLookup(){
			try{
				$query = "SELECT * FROM tblExpectedTeachingCommitmentRateLookup WHERE percentage = '100%'";
				$result = DBConnection::executeQuery($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}			
		}
		
	}//end class
?>