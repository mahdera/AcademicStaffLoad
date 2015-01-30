<?php
	include_once('DBConnection.php');

	class Semester{
		private $semester;
		private $academicYear;

		public function __construct(){
			
		}

		public function Semester($semester,$academicYear)
		{
			$this->setSemester($semester);
			$this->setAcademicYear($academicYear);
		}

		public function setSemester($semester)
		{
			$this->semester = $semester;
		}

		public function setAcademicYear($academicYear)
		{
			$this->academicYear = $academicYear;
		}

		public function getSemester()
		{
			return $this->semester;
		}

		public function getAcademicYear()
		{
			return $this->academicYear;
		}

		public function addSemester()
		{
			try{
				$query = "INSERT INTO tblSemester VALUES('$this->semester','$this->academicYear')";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}

		public function getCurrentSemester()
		{
			try{
				$query = "SELECT * FROM tblSemester";
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		}

		public function deleteSemester($semester,$academicYear)
		{
			try{
				$query = "DELETE FROM tblSemester WHERE semester = '$semester' AND academic_year = '$academicYear'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
	}//end class
?>
