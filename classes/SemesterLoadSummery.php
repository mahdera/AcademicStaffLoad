<?php
	include_once("DBConnection.php");		
	class SemesterLoadSummery{
		private $id;
		private $instructorId;
		private $semester;
		private $year;
		private $fullName;
		private $academicUnitId;
		private $normalCourseLoad;
		private $additionalResponsibilityWaiver;
		private $expectedSemesterLoad;		
		private $undergradCourseLoad;
		private $postgradCourseLoad;
		private $undergradAdvisingLoad;
		private $postgradProjectAdvisingLoad;		
		private $thesisAdvisingLoad;		
		private $totalAdvisingLoad;		
		private $totalSemesterLoad;		
		private $semesterExcessLoad;	
		
		
		public function SemesterLoadSummery($instructorId,$semester,$year,$fullName,$academicUnitId,$normalCourseLoad,$additionalResponsibilityWaiver,$expectedSemesterLoad,$undergradCourseLoad,$postgradCourseLoad, $undergradAdvisingLoad,$postgradProjectAdvisingLoad,$thesisAdvisingLoad,$totalAdvisingLoad, $totalSemesterLoad,$semesterExcessLoad)
		{			
			$this->setInstructorId($instructorId);
			$this->setSemester($semester);
			$this->setYear($year);
			$this->setFullName($fullName);
			$this->setAcademicUnitId($academicUnitId);
			$this->setNormalCourseLoad($normalCourseLoad);
			$this->setAdditionalResponsibilityWaiver($additionalResponsibilityWaiver);
			$this->setExpectedSemesterLoad($expectedSemesterLoad);			
			$this->setUndergradCourseLoad($undergradCourseLoad);
			$this->setPostgradCourseLoad($postgradCourseLoad);
			$this->setUndergradAdvisingLoad($undergradAdvisingLoad);
			$this->setPostgradProjectAdvisingLoad($postgradProjectAdvisingLoad);
			$this->setThesisAdvisingLoad($thesisAdvisingLoad);
			$this->setTotalAdvisingLoad($totalAdvisingLoad);
			$this->setTotalSemesterLoad($totalSemesterLoad);			
			$this->setSemesterExcessLoad($semesterExcessLoad);								
		}	
		
		private function showValues()
		{
			print("==================================<br/>");
			print("instId: $this->instructorId<br/>");
			print("semester: $this->semester<br/>");
			print("year: $this->year<br/>");
			print("fullname: $this->fullName<br/>");
			print("academicunitid: $this->academicUnitId<br/>");
			print("normalcourseload: $this->normalCourseLoad<br/>");
			print("additionalrespo: $this->additionalResponsibilityWaiver<br/>");
			print("expectedsemesterload: $this->expectedSemesterLoad<br/>");
			print("undergradcourseload: $this->undergradCourseLoad<br/>");
			print("postgradcourseload: $this->postgradCourseLoad<br/>");
			print("undergradadvisingload: $this->undergradAdvisingLoad<br/>");
			print("postgradprojectadvisingload: $this->postgradProjectAdvisingLoad<br/>");
			print("thesis advising: $this->thesisAdvisingLoad<br/>");
			print("total advising load: $this->totalAdvisingLoad<br/>");
			print("total semester load: $this->totalSemesterLoad<br/>");
			print("semester excess load: $this->semesterExcessLoad<br/>");
			print("====================================<br/>");			
		}
		
		public function setInstructorId($instructorId)			
		{			
			$this->instructorId = $instructorId;			
		}
		
		public function setSemester($semester)
		{
			$this->semester = $semester;
		}
		
		public function setYear($year)
		{
			$this->year = $year;
		}	
		
		public function setFullName($fullName)
		{
			$this->fullName = $fullName;
		}
		
		public function setAcademicUnitId($academicUnitId)
		{
			$this->academicUnitId = $academicUnitId;
		}
				
		public function setNormalCourseLoad($normalCourseLoad)
		{
			$this->normalCourseLoad = $normalCourseLoad;
		}
		
		public function setAdditionalResponsibilityWaiver($additionalResponsibilityWaiver)
		{
			$this->additionalResponsibilityWaiver = $additionalResponsibilityWaiver;
		}
				
		public function setExpectedSemesterLoad($expectedSemesterLoad)
		{
			$this->expectedSemesterLoad = $expectedSemesterLoad;
		}
				
		public function setUndergradCourseLoad($undergradCourseLoad)
		{
			$this->undergradCourseLoad = $undergradCourseLoad;
		}
		
		public function setPostgradCourseLoad($postgradCourseLoad)
		{
			$this->postgradCourseLoad = $postgradCourseLoad;
		}
		
		public function setUndergradAdvisingLoad($undergradAdvisingLoad)
		{
			$this->undergradAdvisingLoad = $undergradAdvisingLoad;
		}
		
		public function setPostgradProjectAdvisingLoad($postgradProjectAdvisingLoad)
		{
			$this->postgradProjectAdvisingLoad = $postgradProjectAdvisingLoad;
		}
		
		public function setThesisAdvisingLoad($thesisAdvisingLoad)
		{
			$this->thesisAdvisingLoad = $thesisAdvisingLoad;
		}
		
		public function setTotalAdvisingLoad($totalAdvisingLoad)
		{
			$this->totalAdvisingLoad = $totalAdvisingLoad;
		}
		
		public function setTotalSemesterLoad($totalSemesterLoad)
		{
			$this->totalSemesterLoad = $totalSemesterLoad;
		}
		
		public function setSemesterExcessLoad($semesterExcessLoad)
		{
			$this->semesterExcessLoad = $semesterExcessLoad;
		}	
		
		public function setCourseNumber($courseNumber)
		{
			$this->courseNumber = $courseNumber;
		}			
		
		public function getCourseNumber()
		{
			return $this->courseNumber;
		}
		
		public function getInstructorId()
		{
			return $this->instructorId;
		}
		
		public function getSemester()
		{
			return $this->semester;
		}
		
		public function getYear()
		{
			return $this->year;
		}	
		
		public function getFullName()
		{
			return $this->fullName;
		}
		
		public function getAcademicUnitId()
		{
			return $this->academicUnit;
		}
				
		public function getNormalCourseLoad()
		{
			return $this->normalCourseLoad;
		}
		
		public function getAdditionalResponsibilityWaiver()
		{
			return $this->additionalResponsibilityWaiver;
		}
				
		public function getExpectedSemesterLoad()
		{
			return $this->expectedCourseLoad;
		}
				
		public function getUndergradCourseLoad()
		{
			return $this->undergradCourseLoad;
		}
		
		public function getPostgradCourseLoad()
		{
			return $this->postgradCourseLoad;
		}
		
		public function getUndergradAdvisingLoad()
		{
			return $this->undergradAdvisingLoad;
		}
		
		public function getPostgradProjectAdvisingLoad()
		{
			return $this->postgradProjectAdvisingLoad;
		}
		
		public function getThesisAdvisingLoad()
		{
			return $this->thesisAdvisingLoad;
		}
		
		public function getTotalAdvisingLoad()
		{
			return $this->totalAdvisingLoad;
		}
		
		public function getTotalSemesterLoad()
		{
			return $this->totalSemesterLoad;
		}
		
		public function getSemesterExcessLoad()
		{
			return $this->semesterExcessLoad;
		}	
				
		public function addSemesterLoadSummery()
		{
			try{
				$query = "INSERT INTO tblSemesterLoadSummery VALUES(0,'$this->instructorId','$this->semester','$this->year','$this->fullName','$this->academicUnitId',$this->normalCourseLoad,$this->additionalResponsibilityWaiver,$this->expectedSemesterLoad,$this->undergradCourseLoad,$this->postgradCourseLoad,$this->undergradAdvisingLoad,$this->postgradProjectAdvisingLoad,$this->thesisAdvisingLoad,$this->totalAdvisingLoad,$this->totalSemesterLoad,$this->semesterExcessLoad)";
				//print($query);								
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteAllSemesterLoadSummery($academicUnitId)
		{
			try{
				$query = "DELETE FROM tblSemesterLoadSummery WHERE academic_unit_id = '$academicUnitId'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function truncateSemesterLoadSummary()
		{
			try{
				$query = "TRUNCATE TABLE tblSemesterLoadSummery";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
				
		public static function deleteSemesterLoadSummery($id1)//??why did i want this...i dont know the reason...amazing
		{
			
		}
		
		public static function updateInstructorLoad($instructorId,$courseNumber,$numberOfSections,$numberOfStudentsPerSection,$numberOfStudents,$type,$category,$oldCourseNumber,$oldType)		
		{
			try{
				$query = "UPDATE tblInstructorLoad SET course_number='$courseNumber', number_of_sections=$numberOfSections, number_of_students_per_section = $numberOfStudentsPerSection, number_of_students=$numberOfStudents, type='$type', category='$category' WHERE instructor_id='$instructorId' AND course_number='$oldCourseNumber' AND type='$oldType'";
				//print($query);
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getSemesterLoadInfoFor($year,$semester)
		{
			try{
				$query = "SELECT * FROM tblSemesterLoadSummery WHERE year = '$year' AND semester = '$semester'";
				$result = DBConnection::executeQuery($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getSemesterAndYearForAcademicUnit($academicUnitId)
		{
			try{
				$query = "SELECT * FROM tblSemesterLoadSummery WHERE academic_unit_id = '$academicUnitId'";
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllLoadInfoForInstructor($instructorId)
		{
			try{
				$query = "SELECT * FROM tblSemesterLoadSummery WHERE inst_id = '$instructorId'";
				print($query."<br/>");
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
	}//end class
?>