<?php
	include_once("DBConnection.php");
	
	class Course{
		private $courseNumber;
		private $courseTitle;
		private $creditHour;
		private $lectureHour;
		private $labHour;
		private $tutorialHour;
		private $category;
		private $academicUnitId;
		private $totalNumberOfStudents;
		
		public function Course($courseNumber,$courseTitle,$creditHour,$lectureHour,$labHour,$tutorialHour,$category,$academicUnitId,$totalNumberOfStudents)
		{
			$this->setCourseNumber($courseNumber);
			$this->setCourseTitle($courseTitle);
			$this->setCreditHour($creditHour);
			$this->setLectureHour($lectureHour);
			$this->setLabHour($labHour);
			$this->setTutorialHour($tutorialHour);
			$this->setCategory($category);
			$this->setAcademicUnitId($academicUnitId);
			$this->setTotalNumberOfStudents($totalNumberOfStudents);
		}
		
		public function setTotalNumberOfStudents($totalNumberOfStudents)
		{
			$this->totalNumberOfStudents = $totalNumberOfStudents;
		}
		
		public function setLectureHour($lectureHour)
		{
			$this->lectureHour = $lectureHour;
		}
		
		public function setLabHour($labHour)
		{
			$this->labHour = $labHour;
		}
		
		public function setTutorialHour($tutorialHour)
		{
			$this->tutorialHour = $tutorialHour;
		}
		
		public function setCategory($category)
		{
			$this->category = $category;
		}
		
		public function setCourseNumber($courseNumber)
		{
			$this->courseNumber = $courseNumber;
		}
		
		public function setCourseTitle($courseTitle)
		{
			$this->courseTitle = $courseTitle;
		}
		
		public function setCreditHour($creditHour)
		{
			$this->creditHour = $creditHour;
		}
		
		public function setAcademicUnitId($academicUnitId)
		{
			$this->academicUnitId = $academicUnitId;
		}
		
		public function getTotalNumberOfStudents()
		{
			return $this->totalNumberOfStudents;
		}
		
		public function getLectureHour()
		{
			return $this->lectureHour;
		}
		
		public function getLabHour()
		{
			return $this->labHour;
		}
		
		public function getTutorialHour()
		{
			return $this->tutorialHour;
		}
		
		public function getCategory()
		{
			return $this->category;
		}
		
		public function getCourseNumber()
		{
			return $this->courseNumber;
		}
		
		public function getCourseTitle()
		{
			return $this->courseTitle;
		}
		
		public function getCreditHour()
		{
			return $this->creditHour;
		}
		
		public function getAcademicUnitId()
		{
			return $this->academicUnitId;
		}
		
		public function addCourse()
		{
			try{
				$query = "INSERT INTO tblCourse VALUES('$this->courseNumber','$this->courseTitle',$this->creditHour,$this->lectureHour,$this->labHour,$this->tutorialHour,'$this->category','$this->academicUnitId',$this->totalNumberOfStudents)";								
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllCoursesOfThisAcademicUnit($academicUnitId)
		{
			try{
				$query = "SELECT * FROM tblCourse WHERE academic_unit_id = '$academicUnitId'";
				//print($query);
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllCourses()
		{
			try{
				$query = "SELECT * FROM tblCourse";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}	
		
		public static function getThisCourse($courseNumber)
		{
			try{
				$query = "SELECT * FROM tblCourse WHERE course_number = '$courseNumber'";				
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}	
		
		public static function getCourse($courseNumber){
			try{
				$query = "SELECT * FROM tblCourse WHERE course_number = '$courseNumber'";				
				$result = DBConnection::executeQuery($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteCourse($courseNumber)
		{
			try{
				$query = "DELETE FROM tblCourse WHERE course_number = '$courseNumber'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateCourse($courseNumber,$courseTitle,$creditHour,$lectureHour,$labHour,$tutorialHour,$category,$academicUnitId,$totalNumberOfStudents)
		{
			try{
				$query = "UPDATE tblCourse SET course_title = '$courseTitle', credit_hour = $creditHour, lecture_hour = $lectureHour, lab_hour = $labHour, tutorial_hour = $tutorialHour, category = '$category', academic_unit_id = '$academicUnitId', total_number_of_students = $totalNumberOfStudents WHERE course_number = '$courseNumber'";
                                //print($query);
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function howManyCoursesAreInThisAcademicUnit($academicUnitId)
		{
			try{
				$query = "SELECT COUNT(*) AS num FROM tblCourse WHERE academic_unit_id = '$academicUnitId'";
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow->num;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function searchCourseByCourseNumber($courseNumber){
			try{
				$query = "SELECT * FROM tblCourse WHERE course_number LIKE '%$courseNumber%'";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function searchCourseByCourseTitle($courseTitle){
			try{
				$query = "SELECT * FROM tblCourse WHERE course_title LIKE '%$courseTitle%'";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}		
	}//end class
?>