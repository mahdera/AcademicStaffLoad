<?php
	include_once("DBConnection.php");
	class CourseDelivery{
		private $id;
		private $courseDeliveryName;
		
		public function CourseDelivery($courseDeliveryName)
		{
			$this->setCourseDeliveryName($courseDeliveryName);
		}
		
		public function setCourseDeliveryName($courseDeliveryName)
		{
			$this->courseDeliveryName = $courseDeliveryName;
		}
		
		public function getCourseDeliveryName()
		{
			return $this->courseDeliveryName;
		}
		
		public function addCourseDelivery()
		{
			try{
				$query = "INSERT INTO tblCourseDelivery VALUES(0,'$this->courseDeliveryName')";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}			
		}
		
		public static function updateCourseDelivery($id,$courseDeliveryName)
		{
			try{
				$query = "UPDATE tblCourseDelivery SET course_delivery_name = '$courseDeliveryName' WHERE id = $id";
				//print($query);
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteCourseDelivery($id)
		{
			try{
				$query = "DELETE FROM tblCourseDelivery WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getDeliveryTypes()
		{
			try{
				$query = "SELECT * FROM tblCourseDelivery";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
	}//end class
?>