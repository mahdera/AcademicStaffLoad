<?php
	include_once("DBConnection.php");		
	class InstructorLoad{
		private $instructorId;
		private $courseNumber;
		private $numberOfSections;
		private $numberOfStudentsPerSection;
		private $numberOfStudents;
		private $type;
		private $remark;
		private $category;
		private $semister;
		private $academicUnitId;
		
		
		public function InstructorLoad($instructorId,$courseNumber,$numberOfSections,$numberOfStudentsPerSection,$numberOfStudents,$type,$category,$semister,$year,$academicUnitId,$remark)
		{
			$this->setInstructorId($instructorId);
			$this->setCourseNumber($courseNumber);						
			$this->setNumberOfSections($numberOfSections);
			$this->setNumberOfStudentsPerSection($numberOfStudentsPerSection);
			$this->setNumberOfStudents($numberOfStudents);
			$this->setType($type);
			$this->setCategory($category);
			$this->setSemister($semister);
			$this->setYear($year);
			$this->setAcademicUnitId($academicUnitId);
			$this->setRemark($remark);
		}	
		
		public function setRemark($remark){
			$this->remark = $remark;
		}
		
		public function getRemark(){
			return $this->remark;
		}
		
		public function setAcademicUnitId($academicUnitId)
		{
			$this->academicUnitId = $academicUnitId;
		}
		
		public function getAcademicUnitId()
		{
			return $this->academicUnitId;
		}
		
		public function setYear($year)
		{
			$this->year = $year;
		}
		
		public function setSemister($semister)
		{
			$this->semister = $semister;
		}
		
		public function setNumberOfStudentsPerSection($numberOfStudentsPerSection)
		{
			$this->numberOfStudentsPerSection = $numberOfStudentsPerSection;
		}	
		
		public function setNumberOfStudents($numberOfStudents)
		{
			$this->numberOfStudents = $numberOfStudents;
		}
		
		public function setInstructorId($instructorId)
		{
			$this->instructorId = $instructorId;
		}
				
		public function setCourseNumber($courseNumber)
		{
			$this->courseNumber = $courseNumber;
		}
		
		public function setNumberOfSections($numberOfSections)
		{
			$this->numberOfSections = $numberOfSections;
		}
				
		public function setCategory($category)
		{
			$this->category = $category;
		}
				
		public function setType($type)
		{
			$this->type = $type;
		}
		
		public function getYear()
		{
			return $this->year;
		}
				
		public function getInstructorId()
		{
			return $this->instructorId;
		}
				
		public function getCourseNumber()
		{
			return $this->courseNumber;
		}
				
		public function getNumberOfSections()
		{
			return $this->numberOfSectons;
		}
		
		public function getNumberOfStudents()
		{
			return $this->numberOfStudnets;
		}
		
		public function getSemister()
		{
			return $this->semister;
		}
				
		public function getType()
		{
			return $this->type;
		}
				
		public function getCategory()
		{
			return $this->category;
		}
				
		public function addInstructorLoad()
		{
			try{
				$query = "INSERT INTO tblInstructorLoad VALUES('$this->instructorId','$this->courseNumber',$this->numberOfSections,$this->numberOfStudentsPerSection,$this->numberOfStudents,'$this->type','$this->category','$this->semister','$this->year','$this->academicUnitId','$this->remark')";
				//print($query);
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
				
		public static function deleteInstructorLoad($instructorId,$courseNumber,$type)
		{
			try{
				$query = "DELETE FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND course_number='$courseNumber' AND type='$type'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function truncateInstructorLoad()
		{
			try{
				$query = "TRUNCATE TABLE tblInstructorLoad";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateInstructorLoad($instructorId,$oldCourseNumber,$oldType,$newCourseNumber,$numberOfSections,$numberOfStudentsPerSection,$numberOfStudents,$category,$type,$remark)		
		{
			try{
				$query = "UPDATE tblInstructorLoad SET course_number='$newCourseNumber', number_of_sections=$numberOfSections, number_of_students_per_section = $numberOfStudentsPerSection, number_of_students = $numberOfStudents, type='$type', category='$category', remark='$remark' WHERE instructor_id='$instructorId' AND course_number='$oldCourseNumber' AND type = '$oldType'";
				//print($query);
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getNumberOfCoursesGivenByThisInstructor($instructorId)
		{
			try{
				$query = "SELECT COUNT(*) AS numberOfCourses FROM tblInstructorLoad WHERE instructor_id = '$instructorId'";
				//print($query."<br/>");
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getCoursesGivenByThisInstructor($instructorId)
		{
			try{
				$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId'";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function doesThisInstructorHasALoad($instructorId,$academicUnitId)
		{
			try{
				$query = "SELECT COUNT(*) AS loadInfo FROM tblInstructorLoad WHERE instructor_id='$instructorId' AND academic_unit_id = '$academicUnitId'";
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				$loadRow = $resultRow->loadInfo;
				if($loadRow != 0)
					return "Yes";
				else
					return "No";
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function howManyCoursesDoesThisInstructorTeach($instructorId,$academicUnitId)
		{
			try{
				$query = "SELECT COUNT(*) AS numCourse FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId'";
				//print($query);
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				$howManyCourse = $resultRow->numCourse;
				return $howManyCourse;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getInstructorDetail($instructorDetail)
		{
			try{
				$query = "SELECT * FROM tblInstructor";
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllInstructorLoadResultForInstructor($instructorId){
			try{
				$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId'";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
	}//end class
?>