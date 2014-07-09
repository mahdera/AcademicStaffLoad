<?php
	include_once("DBConnection.php");
	
	class Faculty{
		private $facultyId;		
		private $facultyName;
		private $campusId;
		
		public function Faculty($campusId, $facultyId, $facultyName)
		{
			$this->setCampusId($campusId);
			$this->setFacultyId($facultyId);
			$this->setFacultyName($facultyName);
		}
		
		public function setFacultyId($facultyId)
		{
			$this->facultyId = $facultyId;
		}
		
		public function setCampusId($campusId)
		{
			$this->campusId = $campusId;
		}
		
		public function setFacultyName($facultyName)
		{
			$this->facultyName = $facultyName;
	   }
	   
	   public function getFacultyId()
	   {
	   	return $this->facultyId;
	   }
	   
	   public function getCampusId()
	   {
	   	return $this->campusId;
	   }
	   
	   public function getFacultyName()
	   {
	   	return $this->facultyName;
	   }
	   
	   public function addFaculty()
		{
			try{
				$query = "INSERT INTO tblFaculty VALUES('$this->facultyId','$this->campusId','$this->facultyName')";				
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteFaculty($id)
		{
			try{
				$query = "DELETE FROM tblFaculty WHERE id = '$id'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateFaculty($id,$campusId,$facultyName)
		{
			try{
				$query = "UPDATE tblFaculty SET campus_id = '$campusId', faculty_name = '$facultyName' WHERE id = '$id'";                               
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}

    public static function getCampusDetail($campusId)
    {
        try{
            $query = "SELECT * FROM tblCampus WHERE id = '$campusId'";
            $result = DBConnection::readFromDatabase($query);
            $resultRow = mysql_fetch_object($result);
            return $resultRow;
        }catch(Exception $e){
            $e->__toString();
        }
    }
    
    public static function getAllFaculties()
    {
    	try{
    		$query = "SELECT * FROM tblFaculty";
    		$result = DBConnection::readFromDatabase($query);
    		return $result;
    	}catch(Exception $e){
    		$e->__toString();
    	}
    }
    
    public static function getFacultyNameWithFacultyId($facultyId)
    {
    	try{
    		$query = "SELECT * FROM tblFaculty WHERE id = '$facultyId'";
    		//print($query."<br/>");
    		$result = DBConnection::readFromDatabase($query);
    		$resultRow = mysql_fetch_object($result);
    		$facultyName = $resultRow->faculty_name;
    		return $facultyName;
    	}catch(Exception $e){
    		$e->__toString();
    	}
    }
    
    
}//end class
?>