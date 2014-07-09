<?php
	include_once('DBConnection.php');
	
	class RateLookUp{
		private $category;
		private $delivery;
		private $rate;
		private $calculatingMechanism;
		
		public function RateLookUp($category,$delivery,$rate,$calculatingMechanism)
		{
			$this->setCategory($category);
			$this->setDelivery($delivery);
			$this->setRate($rate);
			$this->setCalculatingMechanism($calculatingMechanism);
		}
		
		public function setCalculatingMechanism($calculatingMechanism){
			$this->calculatingMechanism = $calculatingMechanism;
		}
		
		public function setCategory($category)
		{
			$this->category = $category;
		}
		
		public function setDelivery($delivery)
		{
			$this->delivery = $delivery;
		}
		
		public function setRate($rate)
		{
			$this->rate = $rate;
		}
		
		public function getCategory()
		{
			return $this->category;
		}
		
		public function getDelivery()
		{
			return $this->delivery;
		}
		
		public function getRate()
		{
			return $this->rate;
		}
		
		public function getCalculatingMechanism(){
			return $this->calculatingMechanism;
		}
		
		public function addRateLookUp()
		{		
			try{
				$query = "INSERT INTO tblRateLookUp VALUES('$this->category','$this->delivery',$this->rate,'$this->calculatingMechanism')";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteRateLookUp($category,$delivery,$calculatingMechanism)
		{
			try{
				$query = "DELETE FROM tblRateLookUp WHERE category = '$category' AND delivery_type = '$delivery' AND calculating_mechanism = '$calculatingMechanism'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateRateLookUp($category,$delivery,$rate,$calculatingMechanism)
		{
			try{
				$query = "UPDATE tblRateLookUp SET rate = $rate, calculating_mechanism = '$calculatingMechanism' WHERE category = '$category' AND delivery_type = '$delivery'";
				//print($query);
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllRateLookUp()
		{
			try{
				$query = "SELECT * FROM tblRateLookUp";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getTheRate($category,$delivery)
		{
			try{
				$query = "SELECT * FROM tblRateLookUp WHERE category = '$category' AND delivery_type = '$delivery'";				
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				//print("the result in RateLookup is : $resultRow->rate<br/>");
				return $resultRow->rate;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getRateLookupForThisCategoryAndDeliveryType($category,$deliveryType){
			$resultRow = null;
			try{
				$query = "select * from tblRateLookUp where category = '$category' and delivery_type = '$deliveryType'";				
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
			}catch(Exception $e){
				$e->__toString();
			}
			return $resultRow;
		}
		
	}//end class
?>