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
$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name,last_name ASC";						
$resultInstructors = DBConnection::readFromDatabase($query);
//$howManyCourses = Course::howManyCoursesAreInThisAcademicUnit($academicUnitId);

//create a header for the excel file
	$objPHPExcel->getActiveSheet()->setCellValue('A1','Instructor Id');
	$objPHPExcel->getActiveSheet()->setCellValue('B1','First Name');
	$objPHPExcel->getActiveSheet()->setCellValue('C1','Last Name');
	$objPHPExcel->getActiveSheet()->setCellValue('D1','Email');
	$objPHPExcel->getActiveSheet()->setCellValue('E1','Mobile Phone');
	$objPHPExcel->getActiveSheet()->setCellValue('F1','Academic Rank');
	$objPHPExcel->getActiveSheet()->setCellValue('G1','Service Year');
	$objPHPExcel->getActiveSheet()->setCellValue('H1','Specialization');
	$objPHPExcel->getActiveSheet()->setCellValue('I1','Other Respo.');
	
$i = 2;
while($resultInstructorsRow = mysql_fetch_object($resultInstructors))
{
	//do the calculation for each row of each columns
	$colA = "A".$i;
	$colB = "B".$i;
	$colC = "C".$i;
	$colD = "D".$i;
	$colE = "E".$i;
	$colF = "F".$i;
	$colG = "G".$i;
	$colH = "H".$i;
	$colI = "I".$i;
	
	//read the specific datasets from the database
	$instructorId = $resultInstructorsRow->instructor_id;
	$firstName = $resultInstructorsRow->first_name;
	$lastName = $resultInstructorsRow->last_name;
	$email = $resultInstructorsRow->email;
	$mobilePhone = $resultInstructorsRow->mobile_phone;
	$academicRank = $resultInstructorsRow->instructor_level;
	$serviceYear = $resultInstructorsRow->service_year;
	$specialization = $resultInstructorsRow->specialization;
	$otherRespo = $resultInstructorsRow->other_responsibilities;
	
	//now start writing on the excel file i have just created
	$objPHPExcel->getActiveSheet()->setCellValue($colA,$instructorId);
	$objPHPExcel->getActiveSheet()->setCellValue($colB,$firstName);
	$objPHPExcel->getActiveSheet()->setCellValue($colC,$lastName);
	$objPHPExcel->getActiveSheet()->setCellValue($colD,$email);
	$objPHPExcel->getActiveSheet()->setCellValue($colE,$mobilePhone);
	$objPHPExcel->getActiveSheet()->setCellValue($colF,$academicRank);
	$objPHPExcel->getActiveSheet()->setCellValue($colG,$serviceYear);
	$objPHPExcel->getActiveSheet()->setCellValue($colH,$specialization);
	$objPHPExcel->getActiveSheet()->setCellValue($colI,$otherRespo);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	$i++;	
}

//now I need to deal with listing all the parttimers in this department...
$query = "SELECT * FROM tblParttimer WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name,last_name ASC";						
$resultParttimers= DBConnection::readFromDatabase($query);

//now name the columns
	$colA = "A".$i;
	$colB = "B".$i;
	$colC = "C".$i;
	$colD = "D".$i;
	$colE = "E".$i;
	$colF = "F".$i;
	$colG = "G".$i;
	$colH = "H".$i;
	$colI = "I".$i;
	
	$objPHPExcel->getActiveSheet()->setCellValue($colA,'Parttimer Id');
	$objPHPExcel->getActiveSheet()->setCellValue($colB,'First Name');
	$objPHPExcel->getActiveSheet()->setCellValue($colC,'Last Name');
	$objPHPExcel->getActiveSheet()->setCellValue($colD,'Email');
	$objPHPExcel->getActiveSheet()->setCellValue($colE,'Mobile Phone');
	$objPHPExcel->getActiveSheet()->setCellValue($colF,'Academic Rank');
	$objPHPExcel->getActiveSheet()->setCellValue($colG,'Organization');
	$objPHPExcel->getActiveSheet()->setCellValue($colH,'Specialization');
	
	
	$i++;
	while($resultParttimersRow = mysql_fetch_object($resultParttimers))
	{
		//do the calculation for each row of each columns
		$colA = "A".$i;
		$colB = "B".$i;
		$colC = "C".$i;
		$colD = "D".$i;
		$colE = "E".$i;
		$colF = "F".$i;
		$colG = "G".$i;
		$colH = "H".$i;
	
		
		//read the specific datasets from the database
		$parttimerId = $resultParttimersRow->parttimer_id;
		$firstName = $resultParttimersRow->first_name;
		$lastName = $resultParttimersRow->last_name;
		$email = $resultParttimersRow->email;
		$mobilePhone = $resultParttimersRow->mobile_phone;
		$academicRank = $resultParttimersRow->instructor_level;
		$organization = $resultParttimersRow->organization;
		$specialization = $resultParttimersRow->specialization;
	
		
		//now start writing on the excel file i have just created
		$objPHPExcel->getActiveSheet()->setCellValue($colA,$parttimerId);
		$objPHPExcel->getActiveSheet()->setCellValue($colB,$firstName);
		$objPHPExcel->getActiveSheet()->setCellValue($colC,$lastName);
		$objPHPExcel->getActiveSheet()->setCellValue($colD,$email);
		$objPHPExcel->getActiveSheet()->setCellValue($colE,$mobilePhone);
		$objPHPExcel->getActiveSheet()->setCellValue($colF,$academicRank);
		$objPHPExcel->getActiveSheet()->setCellValue($colG,$organization);
		$objPHPExcel->getActiveSheet()->setCellValue($colH,$specialization);
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
		$i++;	
	}	//end while loop
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
  Header("Location: ExportInstructorReportToExcel.xlsx");

?>