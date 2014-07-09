<?php
	include_once("DBConnection.php");
	
	class AcademicUnit{
		private $academicUnitId;
		private $facultyId;
		private $academicUnitName;
		
		public function AcademicUnit($academicUnitId,$facultyId, $academicUnitName)
		{
			$this->setAcademicUnitId($academicUnitId);
			$this->setFacultyId($facultyId);
			$this->setAcademicUnitName($academicUnitName);
		}
		
		public function setAcademicUnitId($academicUnitId)
		{
			$this->academicUnitId = $academicUnitId;
		}
		
		public function setFacultyId($facultyId)
		{
			$this->facultyId = $facultyId;
		}
		
		public function setAcademicUnitName($academicUnitName)
		{
			$this->academicUnitName = $academicUnitName;
		}
		
		public function getAcademicUnitId()
		{
			return $this->academicUnitId;
		}
		
		public function getFacultyId()
		{
			return $this->facultyId;
		}
		
		public function getAcademicUnitName()
		{
			return $this->academicUnitName;
		}
		
		public function addAcademicUnit()
		{
			try{
				$query = "INSERT INTO tblAcademicUnit VALUES('$this->academicUnitId','$this->facultyId','$this->academicUnitName')";				
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteAcademicUnit($id)
		{
			try{
				$query = "DELETE FROM tblAcademicUnit WHERE id = '$id'";								
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateAcademicUnit($id,$facultyId,$academicUnitName)
		{		
			try{
				$query = "UPDATE tblAcademicUnit SET faculty_id = '$facultyId', academic_unit_name = '$academicUnitName' WHERE id = '$id'";                                
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
				
		public static function getAcademicUnitNameFor($academicUnitId)
		{
			try{
				$query = "SELECT * FROM tblAcademicUnit WHERE id = '$academicUnitId'";	
				//print($query."<br/>");			
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getTheFacultyOfThisAcademicUnit($academicUnitId)
		{
			try{
				$query = "SELECT * FROM tblAcademicUnit WHERE id = '$academicUnitId'";
				//print($query."<br/>");//pass
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				$facultyId = $resultRow->faculty_id;
				//print("$facultyId<br/>");//pass
				//now i can query the database with the obtained faculty id
				$facultyResultRow = AcademicUnit::getFacultyDetail($facultyId);
				$facultyName = $facultyResultRow->faculty_name;
				print("$facultyName<br/>");
				return $facultyName;
			}catch(Exception $e){
				$e->__toString();
			}
		}

       public static function getFacultyDetail($facultyId)
       {
           try{
               $query = "SELECT * FROM tblFaculty WHERE id = '$facultyId'";
               //print("inside faculty detail method and $query<br/>");//passed
               $result = DBConnection::readFromDatabase($query);
               $resultRow = mysql_fetch_object($result);
               return $resultRow;
           }catch(Exception $e){
               $e->__toString();
           }
       }
       
       public static function getAllAcademicUnits()
       {
       	try{
       		$query = "SELECT * FROM tblAcademicUnit ORDER BY academic_unit_name ASC";
       		$result = DBConnection::readFromDatabase($query);
       		return $result;
       	}catch(Exception $e){
       		$e->__toString();
       	}
       }
       
       public static function getAcademicUnit($academicUnitId){
       	try{
       		$query = "SELECT * FROM tblAcademicUnit WHERE id = '$academicUnitId'";
       		$result = DBConnection::executeQuery($query);
       		$resultRow = mysql_fetch_object($result);
       		return $resultRow;
       	}catch(Exception $e){
       		$e->__toString();
       	}
       }
       
       public static function getTheMaxAcademicUnitId()
       {
       	$maxId = 0;
       	try{
       		$query = "SELECT MAX(id) AS maxId FROM tblAcademicUnit";
       		//print($query);
       		$result = DBConnection::readFromDatabase($query);
       		$resultObj = mysql_fetch_object($result);
       		$maxId = $resultObj->maxId;
       		return $maxId+1;
       	}catch(Exception $e){
       		$e->__toString();
       	}
       }
		
	}//end class
?>