<?php
	
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2010 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2010 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.4, 2010-08-26
 */

/** Error reporting */
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once '_classes/PHPExcel.php';
include_once('classes/DBConnection.php');
include_once('classes/InstructorLoad.php');
include_once('classes/SemesterLoadSummery.php');
include_once('classes/AcademicUnit.php');
include_once('classes/CourseOffering.php');


// Create new PHPExcel object
//echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
//echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("Mahder Alemayehu")
							 ->setLastModifiedBy("Mahder Alemayehu")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

// Set default font
//echo date('H:i:s') . " Set default font\n";
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);

// Add some data, resembling some different data types
//echo date('H:i:s') . " Add some data\n";
//here comes my modification
@session_start();
$academicUnitId = $_SESSION['deptId'];
$query = "SELECT * FROM tblCourse WHERE academic_unit_id = $academicUnitId ORDER BY course_number ASC";						
$resultCourses = DBConnection::readFromDatabase($query);
//$howManyCourses = Course::howManyCoursesAreInThisAcademicUnit($academicUnitId);

//create a header for the excel file
	$objPHPExcel->getActiveSheet()->setCellValue('A1','Id');
	$objPHPExcel->getActiveSheet()->setCellValue('B1','Name');
	$objPHPExcel->getActiveSheet()->setCellValue('C1','Acad Unit');
	$objPHPExcel->getActiveSheet()->setCellValue('D1','Add Resp Wavier');
	$objPHPExcel->getActiveSheet()->setCellValue('E1','Exp Sem Load');
	$objPHPExcel->getActiveSheet()->setCellValue('F1','UG Course Load');
	$objPHPExcel->getActiveSheet()->setCellValue('G1','PG Course Load');
	$objPHPExcel->getActiveSheet()->setCellValue('H1','UG Advi Load');
	$objPHPExcel->getActiveSheet()->setCellValue('I1','PG Proj Advi Load');
	$objPHPExcel->getActiveSheet()->setCellValue('J1','Thesis Advi Load');
	$objPHPExcel->getActiveSheet()->setCellValue('K1','Total Advi Load');
	$objPHPExcel->getActiveSheet()->setCellValue('L1','Total Semi Load');
	$objPHPExcel->getActiveSheet()->setCellValue('M1','Sem Excess Load');
	$objPHPExcel->getActiveSheet()->setCellValue('N1','Course Number');
	$objPHPExcel->getActiveSheet()->setCellValue('O1','Crhr');
	$objPHPExcel->getActiveSheet()->setCellValue('P1','LEH');
	$objPHPExcel->getActiveSheet()->setCellValue('Q1','LAH');
	$objPHPExcel->getActiveSheet()->setCellValue('R1','Tut Hr');
	$objPHPExcel->getActiveSheet()->setCellValue('S1','Num of Sec');
	$objPHPExcel->getActiveSheet()->setCellValue('T1','Num of Stud');
	$objPHPExcel->getActiveSheet()->setCellValue('U1','Category');
	$objPHPExcel->getActiveSheet()->setCellValue('V1','Type');
	$objPHPExcel->getActiveSheet()->setCellValue('W1','Remark');
	////////now comes the logic May God be with me....
	//now read all instructors in this specific department
	@session_start();
	$academicUnitId = $_SESSION['deptId'];
	$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId'";
	$result = DBConnection::readFromDatabase($query);
	
	
	$i = 2;	
	while($resultRow = mysql_fetch_object($result))//iterate thru all the instrcutors to check that if they have a load or not!
	{
			$colA = "A".$i;
			$colB = "B".$i;
			$colC = "C".$i;
			$colD = "D".$i;
			$colE = "E".$i;
			$colF = "F".$i;
			$colG = "G".$i;
			$colH = "H".$i;
			$colI = "I".$i;
			$colJ = "J".$i;
			$colK = "K".$i;
			$colL = "L".$i;
			$colM = "M".$i;
			
			//now get the instructor infromation from the database and check if he/she has a load in this semester
			$instructorId = $resultRow->instructor_id;
			//now check if this instructor is available in the tblInstructorLoad
			$ans = InstructorLoad::doesThisInstructorHasALoad($instructorId,$academicUnitId);			
			if($ans == "Yes")
			{
				//print("$instructorId has a load<br/>");passed
				//now get the # of courses given by this particular instructor
				$howMany = InstructorLoad::howManyCoursesDoesThisInstructorTeach($instructorId,$academicUnitId);
				$howMany = $howMany + 1;
				//print("$instructorId is teaching $howMany courses<br/>");
				//then comes the need to get all the info from tblSemesterLoadSummery to get the non-repeating info
				
				//$resultSemesterLoadRow = SemesterLoadSummery::getAllLoadInfoForInstructor($instructorId);
				$query = "SELECT * FROM tblSemesterLoadSummery WHERE inst_id = '$instructorId'";
				//print("$query<br>");
				$resultSemesterLoad = DBConnection::readFromDatabase($query);
				$resultSemesterLoadRow = mysql_fetch_object($resultSemesterLoad);				
				
				$fullName = $resultSemesterLoadRow->full_name;
				$normalCourseLoad = $resultSemesterLoadRow->normal_course_load;
				$expectedSemesterLoad = $resultSemesterLoadRow->expected_semester_load;
				$postgradCourseLoad = $resultSemesterLoadRow->post_grad_course_load;
				$additionalResponsibilityWaiver = $resultSemesterLoadRow->additional_responsibility_weaver;
				$undergradCourseLoad = $resultSemesterLoadRow->undergrad_course_load;
				$undergradAdvisingLoad = $resultSemesterLoadRow->undergrad_advising_load;
				$postgradProjectAdvising = $resultSemesterLoadRow->post_grad_project_advising_load;
				$thesisAdvisingLoad = $resultSemesterLoadRow->thesis_advising_load;
				$totalAdvisingLoad = $resultSemesterLoadRow->total_advising_load;
				$totalSemesterLoad = $resultSemesterLoadRow->total_semester_load;
				$semesterExcessLoad = $resultSemesterLoadRow->semester_excess_load;
				//the above datasets will display to column M only
				//get the academicunitname
				$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($resultSemesterLoadRow->academic_unit_id);
				$academicUnitNameResultRow = mysql_fetch_object($academicUnitNameResult);
				$academicUnitName = $academicUnitNameResultRow->academic_unit_name;
				
				//start writing the above datavalues to the excel sheet i just created above
				$objPHPExcel->getActiveSheet()->setCellValue($colA,$instructorId);
				$objPHPExcel->getActiveSheet()->setCellValue($colB,$fullName);
				$objPHPExcel->getActiveSheet()->setCellValue($colC,$academicUnitName);
				$objPHPExcel->getActiveSheet()->setCellValue($colD,$additionalResponsibilityWaiver);
				$objPHPExcel->getActiveSheet()->setCellValue($colE,$expectedSemesterLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colF,$undergradCourseLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colG,$postgradCourseLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colH,$undergradAdvisingLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colI,$postgradProjectAdvising);
				$objPHPExcel->getActiveSheet()->setCellValue($colJ,$thesisAdvisingLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colK,$totalAdvisingLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colL,$totalSemesterLoad);
				//i can check if the semesterExcessLoad is < 0 or not
				if($semesterExcessLoad < 0.0)
					$semesterExcessLoad = "---";
				$objPHPExcel->getActiveSheet()->setCellValue($colM,$semesterExcessLoad);
				
			
				
				//now begin displaying the repeating fields here
				//here i need to get all the courses this particular instructor is teaching 
				
				$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId'";
				$resultLoad = DBConnection::readFromDatabase($query);
				
				while($resultLoadRow = mysql_fetch_object($resultLoad))
				{
					$colN = "N".$i;
					$colO = "O".$i;
					$colP = "P".$i;
					$colQ = "Q".$i;
					$colR = "R".$i;
					$colS = "S".$i;
					$colT = "T".$i;
					$colU = "U".$i;
					$colV = "V".$i;
					$colW = "W".$i;
					
					$courseNumber = $resultLoadRow->course_number;
					$courseDetailRow = CourseOffering::getCourseDetail($courseNumber);
					$creditHour = $courseDetailRow->credit_hour; 
					$lectureHour = $courseDetailRow->lecture_hour;
					$labHour = $courseDetailRow->lab_hour;
					$tutorialHour = $courseDetailRow->tutorial_hour;
					$numberOfSections = $resultLoadRow->number_of_sections;
					$category = $resultLoadRow->category;
					$numberOfStudents = $resultLoadRow->number_of_students;
					$type = $resultLoadRow->type;
					$remark = $resultLoadRow->remark;
					
					//now start wrting the repeating fields in the excel sheet					
					$objPHPExcel->getActiveSheet()->setCellValue($colN,$courseNumber);
					$objPHPExcel->getActiveSheet()->setCellValue($colO,$creditHour);
					$objPHPExcel->getActiveSheet()->setCellValue($colP,$lectureHour);
					$objPHPExcel->getActiveSheet()->setCellValue($colQ,$labHour);
					$objPHPExcel->getActiveSheet()->setCellValue($colR,$tutorialHour);
					$objPHPExcel->getActiveSheet()->setCellValue($colS,$numberOfSections);
					$objPHPExcel->getActiveSheet()->setCellValue($colT,$numberOfStudents);
					$objPHPExcel->getActiveSheet()->setCellValue($colU,$category);
					$objPHPExcel->getActiveSheet()->setCellValue($colV,$type);
					$objPHPExcel->getActiveSheet()->setCellValue($colW,$remark);					
					
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
					$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
					$i++;						
				}//end while...loop...this will loop thru all the courses this instructor is currently teaching
						
					
			}//end if...condition
			//$i++;
		}//end while...loop...this loop will iterate thru all instructor in the academic unit
		
		$i++;
		
		////////////////now do the same shit for all parttimers in the selected academic unit/////////////////
		$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = '$academicUnitId'  ORDER BY first_name, last_name ASC";
		$result = DBConnection::readFromDatabase($query);
		
		//formatting the header for the parttimer table
			$colA = "A".$i;
			$colB = "B".$i;
			$colC = "C".$i;
			$colD = "D".$i;
			$colE = "E".$i;
			$colF = "F".$i;
			$colG = "G".$i;
			$colH = "H".$i;
			$colI = "I".$i;
			$colJ = "J".$i;
			$colK = "K".$i;
			$colL = "L".$i;
			$colM = "M".$i;
			$colN = "N".$i;
			$$colO = "O".$i;
			$colP = "P".$i;
			$colQ = "Q".$i;
			$colR = "R".$i;
			$colS = "S".$i;
			$colT = "T".$i;
			$colU = "U".$i;
			$colV = "V".$i;
			
			//now set the column names for the parttimers in the selected academic unit
			$objPHPExcel->getActiveSheet()->setCellValue($colA,'Id');
			$objPHPExcel->getActiveSheet()->setCellValue($colB,'Name');
			$objPHPExcel->getActiveSheet()->setCellValue($colC,'Acad Unit');
			$objPHPExcel->getActiveSheet()->setCellValue($colD,'Add Resp Wavier');
			$objPHPExcel->getActiveSheet()->setCellValue($colE,'Exp Sem Load');
			$objPHPExcel->getActiveSheet()->setCellValue($colF,'UG Course Load');
			$objPHPExcel->getActiveSheet()->setCellValue($colG,'PG Course Load');
			$objPHPExcel->getActiveSheet()->setCellValue($colH,'UG Advi Load');
			$objPHPExcel->getActiveSheet()->setCellValue($colI,'PG Proj Advi Load');
			$objPHPExcel->getActiveSheet()->setCellValue($colJ,'Thesis Advi Load');
			$objPHPExcel->getActiveSheet()->setCellValue($colK,'Total Advi Load');
			$objPHPExcel->getActiveSheet()->setCellValue($colL,'Total Semi Load');
			$objPHPExcel->getActiveSheet()->setCellValue($colM,'Sem Excess Load');
			$objPHPExcel->getActiveSheet()->setCellValue($colN,'Course Number');
			$objPHPExcel->getActiveSheet()->setCellValue($colO,'Crhr');
			$objPHPExcel->getActiveSheet()->setCellValue($colP,'LEH');
			$objPHPExcel->getActiveSheet()->setCellValue($colQ,'LAH');
			$objPHPExcel->getActiveSheet()->setCellValue($colR,'Tut Hr');
			$objPHPExcel->getActiveSheet()->setCellValue($colS,'Num of Sec');
			$objPHPExcel->getActiveSheet()->setCellValue($colT,'Num of Stud');
			$objPHPExcel->getActiveSheet()->setCellValue($colU,'Category');
			$objPHPExcel->getActiveSheet()->setCellValue($colV,'Type');
			
			//now deal with the contents of the parttimer table................
		 while($resultRow = mysql_fetch_object($result))//iterate thru all the instrcutors to check that if they have a load or not!
		 {
			$colA = "A".$i;
			$colB = "B".$i;
			$colC = "C".$i;
			$colD = "D".$i;
			$colE = "E".$i;
			$colF = "F".$i;
			$colG = "G".$i;
			$colH = "H".$i;
			$colI = "I".$i;
			$colJ = "J".$i;
			$colK = "K".$i;
			$colL = "L".$i;
			$colM = "M".$i;
			
			//now get the instructor infromation from the database and check if he/she has a load in this semester
			$instructorId = $resultRow->parttimer_id;
			//now check if this instructor is available in the tblInstructorLoad
			$ans = InstructorLoad::doesThisInstructorHasALoad($instructorId,$academicUnitId);			
			if($ans == "Yes")
			{
				//print("$instructorId has a load<br/>");passed
				//now get the # of courses given by this particular instructor
				$howMany = InstructorLoad::howManyCoursesDoesThisInstructorTeach($instructorId,$academicUnitId);
				$howMany = $howMany + 1;
				//print("$instructorId is teaching $howMany courses<br/>");
				//then comes the need to get all the info from tblSemesterLoadSummery to get the non-repeating info
				
				//$resultSemesterLoadRow = SemesterLoadSummery::getAllLoadInfoForInstructor($instructorId);
				$query = "SELECT * FROM tblSemesterLoadSummery WHERE inst_id = '$instructorId' AND academic_unit_id = '$academicUnitId'";
				//print("$query<br>");
				$resultSemesterLoad = DBConnection::readFromDatabase($query);
				$resultSemesterLoadRow = mysql_fetch_object($resultSemesterLoad);				
				
				$fullName = $resultSemesterLoadRow->full_name;
				$normalCourseLoad = $resultSemesterLoadRow->normal_course_load;
				$expectedSemesterLoad = $resultSemesterLoadRow->expected_semester_load;
				$postgradCourseLoad = $resultSemesterLoadRow->post_grad_course_load;
				$additionalResponsibilityWaiver = $resultSemesterLoadRow->additional_responsibility_weaver;
				$undergradCourseLoad = $resultSemesterLoadRow->undergrad_course_load;
				$undergradAdvisingLoad = $resultSemesterLoadRow->undergrad_advising_load;
				$postgradProjectAdvising = $resultSemesterLoadRow->post_grad_project_advising_load;
				$thesisAdvisingLoad = $resultSemesterLoadRow->thesis_advising_load;
				$totalAdvisingLoad = $resultSemesterLoadRow->total_advising_load;
				$totalSemesterLoad = $resultSemesterLoadRow->total_semester_load;
				$semesterExcessLoad = $resultSemesterLoadRow->semester_excess_load;
				//the above datasets will display to column M only
				//get the academicunitname
				$academicUnitNameResult = AcademicUnit::getAcademicUnitNameFor($resultSemesterLoadRow->academic_unit_id);
				$academicUnitNameResultRow = mysql_fetch_object($academicUnitNameResult);
				$academicUnitName = $academicUnitNameResultRow->academic_unit_name;
				
				//start writing the above datavalues to the excel sheet i just created above
				$objPHPExcel->getActiveSheet()->setCellValue($colA,$instructorId);
				$objPHPExcel->getActiveSheet()->setCellValue($colB,$fullName);
				$objPHPExcel->getActiveSheet()->setCellValue($colC,$academicUnitName);
				$objPHPExcel->getActiveSheet()->setCellValue($colD,$additionalResponsibilityWaiver);
				$objPHPExcel->getActiveSheet()->setCellValue($colE,$expectedSemesterLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colF,$undergradCourseLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colG,$postgradCourseLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colH,$undergradAdvisingLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colI,$postgradProjectAdvising);
				$objPHPExcel->getActiveSheet()->setCellValue($colJ,$thesisAdvisingLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colK,$totalAdvisingLoad);
				$objPHPExcel->getActiveSheet()->setCellValue($colL,$totalSemesterLoad);
				//i can check if the semesterExcessLoad is < 0 or not
				if($semesterExcessLoad < 0.0)
					$semesterExcessLoad = "---";
				$objPHPExcel->getActiveSheet()->setCellValue($colM,$semesterExcessLoad);
				
			
				
				//now begin displaying the repeating fields here
				//here i need to get all the courses this particular instructor is teaching 
				
				$query = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId'";
				$resultLoad = DBConnection::readFromDatabase($query);
				
				while($resultLoadRow = mysql_fetch_object($resultLoad))
				{
					$colN = "N".$i;
					$colO = "O".$i;
					$colP = "P".$i;
					$colQ = "Q".$i;
					$colR = "R".$i;
					$colS = "S".$i;
					$colT = "T".$i;
					$colU = "U".$i;
					$colV = "V".$i;
					
					$courseNumber = $resultLoadRow->course_number;
					$courseDetailRow = CourseOffering::getCourseDetail($courseNumber);
					$creditHour = $courseDetailRow->credit_hour; 
					$lectureHour = $courseDetailRow->lecture_hour;
					$labHour = $courseDetailRow->lab_hour;
					$tutorialHour = $courseDetailRow->tutorial_hour;
					$numberOfSections = $resultLoadRow->number_of_sections;
					$category = $resultLoadRow->category;
					$numberOfStudents = $resultLoadRow->number_of_students;
					$type = $resultLoadRow->type;
					//now start wrting the repeating fields in the excel sheet					
					$objPHPExcel->getActiveSheet()->setCellValue($colN,$courseNumber);
					$objPHPExcel->getActiveSheet()->setCellValue($colO,$creditHour);
					$objPHPExcel->getActiveSheet()->setCellValue($colP,$lectureHour);
					$objPHPExcel->getActiveSheet()->setCellValue($colQ,$labHour);
					$objPHPExcel->getActiveSheet()->setCellValue($colR,$tutorialHour);
					$objPHPExcel->getActiveSheet()->setCellValue($colS,$numberOfSections);
					$objPHPExcel->getActiveSheet()->setCellValue($colT,$numberOfStudents);
					$objPHPExcel->getActiveSheet()->setCellValue($colU,$category);
					$objPHPExcel->getActiveSheet()->setCellValue($colV,$type);
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
					$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
					$i++;						
				}//end while...loop...this will loop thru all the courses this instructor is currently teaching
						
					
			}//end if...condition
			$i++;
		}//end while...loop...this loop will iterate thru all instructor in the academic unit		
			
		
	
	
// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('Datatypes');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

//i may need a code to move the created excel file to a specific location or open the file in ms excel??
//read about it Mahder


// Echo memory peak usage
//echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";
//Header("Location: UserArea.php");
//print("<a href='ExportCourseReportToExcel.xlsx'>View Excel Document here</a>");
  Header("Location: ExportLoadReportToExcel.xlsx");

?>