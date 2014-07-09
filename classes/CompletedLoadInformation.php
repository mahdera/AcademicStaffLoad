<?php
include_once 'DBConnection.php';
include_once 'Semester.php';
class CompletedLoadInformation{
	private $id;
	private $academicUnitId;
	private $academicYear;
	private $semester;
	private $dateCompleted;
	
	public function CompletedLoadInformation($academicUnitId,$academicYear,$semester)
		{
			$this->setAcademicUnitId($academicUnitId);
			$this->setAcademicYear($academicYear);
			$this->setSemester($semester);						
		}
		
		public function setAcademicUnitId($academicUnitId){
			$this->academicUnitId = $academicUnitId;
		}
		
		public function setAcademicYear($academicYear){
			$this->academicYear = $academicYear;
		}
		
		public function setSemester($semester){
			$this->semester = $semester;
		}
		
		
		
		public function getAcademicUnitId(){
			return $this->academicUnitId;
		}
		
		public function getAcademicYear(){
			return $this->academicYear;
		}
		
		public function getSemester(){
			return $this->semester;
		}
		
		
		
		public function addCompletedLoadInformation(){
			try{
				$query = "INSERT INTO tblCompletedLoadInformation VALUES(0,'$this->academicUnitId','$this->academicYear','$this->semester',NOW())";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateCompletedLoadInformation(){
		}
		
		public static function deleteCompletedLoadInformation($id){
			try{
				$query = "DELETE FROM tblCompletedLoadInformation WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllCompletedLoadInformations(){
			try{
				$query = "SELECT * FROM tblCompletedLoadInformation ORDER BY date_completed DESC";
				$result = DBConnection::executeQuery($query);				
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllCompetedLoadInformationForTheCurrentAcademicYear(){
			try{
				//first get the current semester from the semester class
				$semesterObj = Semester::getCurrentSemester();
				$query = "SELECT * FROM tblCompletedLoadInformation WHERE academic_year = '$semesterObj->academic_year' AND semester = '$semesterObj->semester' ORDER BY date_completed DESC";
				$result = DBConnection::executeQuery($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getCompletedLoadInformation($id){
			try{
				$query = "SELECT * FROM tblCompletedLoadInformation WHERE id = $id";
				$result = DBConnection::executeQuery($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		} 
		
		public static function hasThisAcademicUnitCompletedLoadProcessing($deptId,$academicYear,$semester){
			$hasComp = "false";
			try{
				$query = "SELECT COUNT(*) AS comp FROM tblCompletedLoadInformation WHERE academic_unit_id = '$deptId' AND academic_year = '$academicYear' AND semester = '$semester'";
				$result = DBConnection::executeQuery($query);
				$resultRow = mysql_fetch_object($result);
				$comp = $resultRow->comp;
				if($comp != 0)
					$hasComp = "true";
			}catch(Exception $e){
				$e->__toString();
			}
			return $hasComp;
		}
}//end class
?>