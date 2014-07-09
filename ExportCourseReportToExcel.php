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
 
 //ob_start();
 @session_start();

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
$academicUnitId = $_SESSION['deptId'];
$query = "SELECT * FROM tblCourse WHERE academic_unit_id = '$academicUnitId' ORDER BY course_number ASC";

//print($query);						
$resultCourses = DBConnection::readFromDatabase($query);
//$howManyCourses = Course::howManyCoursesAreInThisAcademicUnit($academicUnitId);

//create a header for the excel file
	$objPHPExcel->getActiveSheet()->setCellValue('A1','Course Number');
	$objPHPExcel->getActiveSheet()->setCellValue('B1','Course Title');
	$objPHPExcel->getActiveSheet()->setCellValue('C1','Credit Hour');
	$objPHPExcel->getActiveSheet()->setCellValue('D1','Lecture Hour');
	$objPHPExcel->getActiveSheet()->setCellValue('E1','Lab Hour');
	$objPHPExcel->getActiveSheet()->setCellValue('F1','Category');
	$objPHPExcel->getActiveSheet()->setCellValue('G1','Total Number of Students');
	
$i = 2;
while($resultCoursesRow = mysql_fetch_object($resultCourses))
{
	//do the calculation for each row of each columns
	$colA = "A".$i;
	$colB = "B".$i;
	$colC = "C".$i;
	$colD = "D".$i;
	$colE = "E".$i;
	$colF = "F".$i;
	$colG = "G".$i;
	//read the specific datasets from the database
	$courseNumber = $resultCoursesRow->course_number;
	$courseTitle = $resultCoursesRow->course_title;
	$creditHour = $resultCoursesRow->credit_hour;
	$lectureHour = $resultCoursesRow->lecture_hour;
	$labHour = $resultCoursesRow->lab_hour;
	$category = $resultCoursesRow->category;
	$totalNumberOfStudents = $resultCoursesRow->total_number_of_students;
	
	//now start writing on the excel file i have just created
	
	$objPHPExcel->getActiveSheet()->setCellValue($colA,$courseNumber);
	$objPHPExcel->getActiveSheet()->setCellValue($colB,$courseTitle);
	$objPHPExcel->getActiveSheet()->setCellValue($colC,$creditHour);
	$objPHPExcel->getActiveSheet()->setCellValue($colD,$lectureHour);
	$objPHPExcel->getActiveSheet()->setCellValue($colE,$labHour);
	$objPHPExcel->getActiveSheet()->setCellValue($colF,$category);
	$objPHPExcel->getActiveSheet()->setCellValue($colG,$totalNumberOfStudents);	
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
	$i++;	
}

// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
//$objPHPExcel->getActiveSheet()->setTitle('Datatypes');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

		header("Content-type: application/vnd.ms-excel"); 
		//header("Content-Disposition: attachment; filename=$this->filename"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 

//i may need a code to move the created excel file to a specific location or open the file in ms excel??
//read about it Mahder


// Echo memory peak usage
//echo date('H:i:s') . " Peak memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB\r\n";

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";
//Header("Location: UserArea.php");
//print("<a href='ExportCourseReportToExcel.xlsx'>View Excel Document here</a>");
  Header("Location: ExportCourseReportToExcel.xlsx");
?>