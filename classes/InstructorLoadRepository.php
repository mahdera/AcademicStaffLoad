<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InstructorLoadRepository
 *
 * @author mahder
 */
 include_once('DBConnection.php');
 
class InstructorLoadRepository {
    private $instructorId;
    private $courseNumber;
    private $numberOfSections;
    private $numberOfStudentsPerSection;
    private $numberOfStudents;
    private $type;
    private $category;
    private $semester;
    private $year;
    private $academicUnitId;

    function __construct($instructorId, $courseNumber, $numberOfSections, $numberOfStudentsPerSection, $numberOfStudents, $type, $category, $semester, $year, $academicUnitId) {
        $this->instructorId = $instructorId;
        $this->courseNumber = $courseNumber;
        $this->numberOfSections = $numberOfSections;
        $this->numberOfStudentsPerSection = $numberOfStudentsPerSection;
        $this->numberOfStudents = $numberOfStudents;
        $this->type = $type;
        $this->category = $category;
        $this->semester = $semester;
        $this->year = $year;
        $this->academicUnitId = $academicUnitId;
    }

    public function getInstructorId() {
        return $this->instructorId;
    }

    public function setInstructorId($instructorId) {
        $this->instructorId = $instructorId;
    }

    public function getCourseNumber() {
        return $this->courseNumber;
    }

    public function setCourseNumber($courseNumber) {
        $this->courseNumber = $courseNumber;
    }

    public function getNumberOfSections() {
        return $this->numberOfSections;
    }

    public function setNumberOfSections($numberOfSections) {
        $this->numberOfSections = $numberOfSections;
    }

    public function getNumberOfStudentsPerSection() {
        return $this->numberOfStudentsPerSection;
    }

    public function setNumberOfStudentsPerSection($numberOfStudentsPerSection) {
        $this->numberOfStudentsPerSection = $numberOfStudentsPerSection;
    }

    public function getNumberOfStudents() {
        return $this->numberOfStudents;
    }

    public function setNumberOfStudents($numberOfStudents) {
        $this->numberOfStudents = $numberOfStudents;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getSemester() {
        return $this->semester;
    }

    public function setSemester($semester) {
        $this->semester = $semester;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function getAcademicUnitId() {
        return $this->academicUnitId;
    }

    public function setAcademicUnitId($academicUnitId) {
        $this->academicUnitId = $academicUnitId;
    }
    
    public static function importDataFromInstructorLoad()
    {
    	try{
    		$query = "SELECT * FROM tblInstructorLoad";
    		$resultInstructorLoad = DBConnection::readFromDatabase($query);
    		while($resultInstructorLoadRow = mysql_fetch_object($resultInstructorLoad))
    		{
    			$instructorId = $resultInstructorLoadRow->instructor_id;
    			$courseNumber = $resultInstructorLoadRow->course_number;
    			$numberOfSections = $resultInstructorLoadRow->number_of_sections;
    			$numberOfStudentsPerSection = $resultInstructorLoadRow->number_of_students_per_section;
    			$numberOfStudents = $resultInstructorLoadRow->number_of_students;
    			$type = $resultInstructorLoadRow->type;
    			$category = $resultInstructorLoadRow->category;
    			$semester = $resultInstructorLoadRow->semister;
    			$year = $resultInstructorLoadRow->year;
    			$academicUnitId = $resultInstructorLoadRow->academic_unit_id;
    			//now create the object and save it to the database
    			$instructorLoadRepositoryObj = new InstructorLoadRepository($instructorId, $courseNumber, $numberOfSections, $numberOfStudentsPerSection, $numberOfStudents, $type, $category, $semester, $year, $academicUnitId);
    			$instructorLoadRepositoryObj->addInstructorLoadRepository();
    		}
    	}catch(Exception $e){
    		$e->__toString();
    	}
    }
    
    
    public function addInstructorLoadRepository()
    {
    	try{
    		$query = "INSERT INTO tblInstructorLoadRepository VALUES('$this->instructorId','$this->courseNumber',$this->numberOfSections,$this->numberOfStudentsPerSection,$this->numberOfStudents,'$this->type','$this->category','$this->semester','$this->year','$this->academicUnitId')";
    		DBConnection::executeQuery($query);
    	}catch(Exception $e){
    		$e->__toString();
    	}
    }    
    
    public static function deleteInstructorLoad($instructorId,$courseNumber,$type,$category,$semester,$year)
		{
			try{
				$query = "DELETE FROM tblInstructorLoadRepository WHERE instructor_id = '$instructorId' AND course_number='$courseNumber' AND type='$type' AND category = '$category' AND semister = '$semester' AND year = '$year'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		/*I dont think i need this method....for the history...LOL*/		
		public static function updateInstructorLoad($instructorId,$oldCourseNumber,$newCourseNumber,$numberOfSections,$numberOfStudentsPerSection,$numberOfStudents,$category,$type)		
		{
			try{
				$query = "UPDATE tblInstructorLoadRepository SET course_number='$newCourseNumber', number_of_sections=$numberOfSections, number_of_students_per_section = $numberOfStudentsPerSection, number_of_students = $numberOfStudents, type='$type', category='$category' WHERE instructor_id='$instructorId' AND course_number='$oldCourseNumber'";
				//print($query);
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getNumberOfCoursesGivenByThisInstructor($instructorId,$semester,$year)
		{
			try{
				$query = "SELECT COUNT(*) AS numberOfCourses FROM tblInstructorLoadRepository WHERE instructor_id = '$instructorId' AND semister = '$semester' AND year = '$year'";
				//print($query."<br/>");
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getCoursesGivenByThisInstructor($instructorId,$semester,$year)
		{
			try{
				$query = "SELECT * FROM tblInstructorLoadRepository WHERE instructor_id = '$instructorId', semister = '$semester' AND year = '$year'";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function doesThisInstructorHasALoad($instructorId,$academicUnitId,$semester,$year)
		{
			try{
				$query = "SELECT COUNT(*) AS loadInfo FROM tblInstructorLoadRepository WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId' AND semister = '$semester' AND year = '$year'";
				//print($query);
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
		
		public static function howManyCoursesDoesThisInstructorTeach($instructorId,$academicUnitId,$semester,$year)
		{
			try{
				$query = "SELECT COUNT(*) AS numCourse FROM tblInstructorLoadRepository WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId' AND semister = '$semester' AND year = '$year'";
				//print($query);
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				$howManyCourse = $resultRow->numCourse;
				return $howManyCourse;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		/**Some times i think i am creazy...why on Earth do i need this method in here....u see i dont know and i cant delete it from here funny like hell**/
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



}//end class
?>
