<?php
	include_once("DBConnection.php");
	class AdminPosition{
		private $id;
		private $adminPositionName;
		private $equivalentCredit;
		
		public function AdminPosition($adminPositionName,$equivalentCredit)
		{
			$this->setAdminPositionName($adminPositionName);
			$this->setEquivalentCredit($equivalentCredit);
		}
		
		public function setEquivalentCredit($equivalentCredit)
		{
			$this->equivalentCredit = $equivalentCredit;
		}
		
		public function setAdminPositionName($adminPositionName)
		{
			$this->adminPositionName = $adminPositionName;
		}
		
		public function getAdminPositionName()
		{
			return $this->adminPositionName;
		}
		
		public function getEquivalentCredit()
		{
			return $this->equivalentCredit;
		}
		
		public function addAdminPosition()
		{
			try{
				$query = "INSERT INTO tblAdminPosition VALUES(0,'$this->adminPositionName', $this->equivalentCredit)";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}			
		}
		
		public static function updateAdminPosition($id,$adminPositionName,$equivalentCredit)
		{
			try{
				$query = "UPDATE tblAdminPosition SET admin_position_name = '$adminPositionName', equivalent_credit = $equivalentCredit WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteAdminPosition($id)
		{
			try{
				$query = "DELETE FROM tblAdminPosition WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getPositionName($id)
		{
			try{
				$query = "SELECT * FROM tblAdminPosition WHERE id = $id";				
				$result = DBConnection::executeQuery($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getPositionNameFor($id)
		{
			try{
				$query = "SELECT * FROM tblAdminPosition WHERE id = $id";
				//print($query);				
				$result = DBConnection::executeQuery($query);
				$resultRow = mysql_fetch_object($result);
				$positionName = $resultRow->admin_position_name;
				return $positionName;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllAdminPositions()
		{
			try{
				$query = "SELECT * FROM tblAdminPosition";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
	}//end class
?>