<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadSummaryRepository
 *
 * @author mahder
 */
 include_once('DBConnection.php');
class LoadSummaryRepository {    
    private $instId;
    private $semester;
    private $year;
    private $fullName;
    private $academicUnitId;
    private $normalCourseLoad;
    private $additionalResponsibilityWeaver;
    private $expectedSemesterLoad;
    private $undergradCourseLoad;
    private $postgradCourseLoad;
    private $undergradAdvisingLoad;
    private $postgradProjectAdvising;
    private $thesisAdvisingLoad;
    private $totalAdvisingLoad;
    private $totalSemesterLoad;
    private $semesterExcessLoad;

    function __construct($instId, $semester, $year, $fullName, $academicUnitId, $normalCourseLoad, $additionalResponsibilityWeaver, $expectedSemesterLoad, $undergradCourseLoad, $postgradCourseLoad, $undergradAdvisingLoad, $postgradProjectAdvising, $thesisAdvisingLoad, $totalAdvisingLoad, $totalSemesterLoad, $semesterExcessLoad) {
        $this->instId = $instId;
        $this->semester = $semester;
        $this->year = $year;
        $this->fullName = $fullName;
        $this->academicUnitId = $academicUnitId;
        $this->normalCourseLoad = $normalCourseLoad;
        $this->additionalResponsibilityWeaver = $additionalResponsibilityWeaver;
        $this->expectedSemesterLoad = $expectedSemesterLoad;
        $this->undergradCourseLoad = $undergradCourseLoad;
        $this->postgradCourseLoad = $postgradCourseLoad;
        $this->undergradAdvisingLoad = $undergradAdvisingLoad;
        $this->postgradProjectAdvising = $postgradProjectAdvising;
        $this->thesisAdvisingLoad = $thesisAdvisingLoad;
        $this->totalAdvisingLoad = $totalAdvisingLoad;
        $this->totalSemesterLoad = $totalSemesterLoad;
        $this->semesterExcessLoad = $semesterExcessLoad;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getInstId() {
        return $this->instId;
    }

    public function setInstId($instId) {
        $this->instId = $instId;
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

    public function getFullName() {
        return $this->fullName;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }

    public function getAcademicUnitId() {
        return $this->academicUnitId;
    }

    public function setAcademicUnitId($academicUnitId) {
        $this->academicUnitId = $academicUnitId;
    }

    public function getNormalCourseLoad() {
        return $this->normalCourseLoad;
    }

    public function setNormalCourseLoad($normalCourseLoad) {
        $this->normalCourseLoad = $normalCourseLoad;
    }

    public function getAdditionalResponsibilityWeaver() {
        return $this->additionalResponsibilityWeaver;
    }

    public function setAdditionalResponsibilityWeaver($additionalResponsibilityWeaver) {
        $this->additionalResponsibilityWeaver = $additionalResponsibilityWeaver;
    }

    public function getExpectedSemesterLoad() {
        return $this->expectedSemesterLoad;
    }

    public function setExpectedSemesterLoad($expectedSemesterLoad) {
        $this->expectedSemesterLoad = $expectedSemesterLoad;
    }

    public function getUndergradCourseLoad() {
        return $this->undergradCourseLoad;
    }

    public function setUndergradCourseLoad($undergradCourseLoad) {
        $this->undergradCourseLoad = $undergradCourseLoad;
    }

    public function getPostgradCourseLoad() {
        return $this->postgradCourseLoad;
    }

    public function setPostgradCourseLoad($postgradCourseLoad) {
        $this->postgradCourseLoad = $postgradCourseLoad;
    }

    public function getUndergradAdvisingLoad() {
        return $this->undergradAdvisingLoad;
    }

    public function setUndergradAdvisingLoad($undergradAdvisingLoad) {
        $this->undergradAdvisingLoad = $undergradAdvisingLoad;
    }

    public function getPostgradProjectAdvising() {
        return $this->postgradProjectAdvising;
    }

    public function setPostgradProjectAdvising($postgradProjectAdvising) {
        $this->postgradProjectAdvising = $postgradProjectAdvising;
    }

    public function getThesisAdvisingLoad() {
        return $this->thesisAdvisingLoad;
    }

    public function setThesisAdvisingLoad($thesisAdvisingLoad) {
        $this->thesisAdvisingLoad = $thesisAdvisingLoad;
    }

    public function getTotalAdvisingLoad() {
        return $this->totalAdvisingLoad;
    }

    public function setTotalAdvisingLoad($totalAdvisingLoad) {
        $this->totalAdvisingLoad = $totalAdvisingLoad;
    }

    public function getTotalSemesterLoad() {
        return $this->totalSemesterLoad;
    }

    public function setTotalSemesterLoad($totalSemesterLoad) {
        $this->totalSemesterLoad = $totalSemesterLoad;
    }

    public function getSemesterExcessLoad() {
        return $this->semesterExcessLoad;
    }

    public function setSemesterExcessLoad($semesterExcessLoad) {
        $this->semesterExcessLoad = $semesterExcessLoad;
    }

	 //copy contents from tblSemesterLoadSummary
	 public static function importDataFromSemesterLoadSummary()
	 {
	 	try{
	 		$query = "SELECT * FROM tblSemesterLoadSummery";
	 		$resultSemesterLoadSummery = DBConnection::readFromDatabase($query);
	 		while($resultSemesterLoadSummeryRow = mysql_fetch_object($resultSemesterLoadSummery))
	 		{
	 			$instId = $resultSemesterLoadSummeryRow->inst_id;
	 			$semester = $resultSemesterLoadSummeryRow->semester;
	 			$year = $resultSemesterLoadSummeryRow->year;
	 			$fullName = $resultSemesterLoadSummeryRow->full_name;
	 			$academicUnitId = $resultSemesterLoadSummeryRow->academic_unit_id;
	 			$normalCourseLoad = $resultSemesterLoadSummeryRow->normal_course_load;
	 			$additionalResponsibilityWeaver = $resultSemesterLoadSummeryRow->additional_responsibility_weaver;
	 			$expectedSemesterLoad = $resultSemesterLoadSummeryRow->expected_semester_load;
	 			$undergradCourseLoad = $resultSemesterLoadSummeryRow->undergrad_course_load;
	 			$postgradCourseLoad = $resultSemesterLoadSummeryRow->post_grad_course_load;
	 			$undergradAdvisingLoad = $resultSemesterLoadSummeryRow->undergrad_advising_load;
	 			$postgradProjectAdvising = $resultSemesterLoadSummeryRow->post_grad_project_advising_load;
	 			$thesisAdvisingLoad = $resultSemesterLoadSummeryRow->thesis_advising_load;
	 			$totalAdvisingLoad = $resultSemesterLoadSummeryRow->total_advising_load;
	 			$totalSemesterLoad = $resultSemesterLoadSummeryRow->total_semester_load;
	 			$semesterExcessLoad = $resultSemesterLoadSummeryRow->semester_excess_load;
	 			//now create the LoadSummaryRepository object and save this record to the table
	 			$loadSummaryRepositoryObj = new LoadSummaryRepository($instId, $semester, $year,
	 			 $fullName, $academicUnitId, $normalCourseLoad, $additionalResponsibilityWeaver, 
	 			 $expectedSemesterLoad, $undergradCourseLoad, $postgradCourseLoad, $undergradAdvisingLoad, 
	 			 $postgradProjectAdvising, $thesisAdvisingLoad, $totalAdvisingLoad, $totalSemesterLoad, 
	 			 $semesterExcessLoad);
	 			 $loadSummaryRepositoryObj->addLoadSummaryRepository();
	 		}//end while loop
	 	}catch(Exception $e){
	 		$e->__toString();
	 	}
	 }
	 
	 public function addLoadSummaryRepository()
	 {
	 		try{
				$query = "INSERT INTO tblLoadSummaryRepository VALUES(0,'$this->instId','$this->semester','$this->year','$this->fullName','$this->academicUnitId',$this->normalCourseLoad,$this->additionalResponsibilityWeaver,$this->expectedSemesterLoad,$this->undergradCourseLoad,$this->postgradCourseLoad,$this->undergradAdvisingLoad,$this->postgradProjectAdvising,$this->thesisAdvisingLoad,$this->totalAdvisingLoad,$this->totalSemesterLoad,$this->semesterExcessLoad)";
				//print($query);								
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
	 }
		
		public static function deleteAllSemesterLoadSummery($academicUnitId)
		{
			try{
				$query = "DELETE FROM tblLoadSummaryRepository WHERE academic_unit_id = '$academicUnitId'";
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
				$query = "SELECT * FROM tblLoadSummaryRepository WHERE year = '$year' AND semester = '$semester'";
				$result = DBConnection::executeQuery($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getSemesterAndYearForAcademicUnit($academicUnitId)
		{
			try{
				$query = "SELECT * FROM tblLoadSummaryRepository WHERE academic_unit_id = '$academicUnitId'";
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
				$query = "SELECT * FROM tblLoadSummaryRepository WHERE inst_id = '$instructorId'";
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
