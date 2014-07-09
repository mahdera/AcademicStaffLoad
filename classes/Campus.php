<?php
	include_once("DBConnection.php");
   class Campus{
		private $id;
		private $campusName;
		
		public function Campus($id,$campusName)
		{
			$this->setCampusId($id);
			$this->setCampusName($campusName);
		}
		
		public function setCampusId($id)
		{
			$this->id = $id;
		}
		
		public function setCampusName($campusName)
		{
			$this->campusName = $campusName;
		}
		
		public function getCampusName()
		{
			return $this->campusName;
		}
		
		public function addCampus()
		{
			try{
				$query = "INSERT INTO tblCampus VALUES('$this->id','$this->campusName')";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteCampus($id)
		{
			try{
				$query = "DELETE FROM tblCampus WHERE id = '$id'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateCampus($id,$campusName)
		{
			try{
				$query = "UPDATE tblCampus SET campus_name = '$campusName' WHERE id = '$id'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
               
	}//end class
?>