<?php
	require('../fpdf.php');
	include_once('../../classes/DBConnection.php');
	
	class PDF extends FPDF
	{
		private $academicUnitId;// = $_SESSION['deptId'];		
		function LoadData()
		{		
			//now try to read data form the underlying database
			$academicUnitId = $_SESSION['deptId'];
			$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = $academicUnitId ORDER BY first_name";
			$resultInstructor = DBConnection::readFromDatabase($query);	
			$data = array();
			
			$ctr = 0;
			while($resultInstructorRow = mysql_fetch_object($resultInstructor))
			{
				$instructorId = $resultInstructorRow->instructor_id;
				$firstName = $resultInstructorRow->first_name;
				$lastName = $resultInstructorRow->last_name;
				$email = $resultInstructorRow->email;
				$mobilePhone = $resultInstructorRow->mobile_phone;
				$academicRank = $resultInstructorRow->instructor_level;
				$serviceYear = $resultInstructorRow->service_year;
				$specialization = $resultInstructorRow->specialization;
				$otherRespo = $resultInstructorRow->other_responsibilities;
				//now put this fields in the array
				$data[$ctr] = $instructorId;
				$ctr++;
				$data[$ctr] = $firstName;
				$ctr++;
				$data[$ctr] = $lastName;
				$ctr++;
				$data[$ctr] = $email;
				$ctr++;
				$data[$ctr] = $mobilePhone;
				$ctr++;
				$data[$ctr] = $academicRank;
				$ctr++;
				$data[$ctr] = $serviceYear;
				$ctr++;
				$data[$ctr] = $specialization;
				$ctr++;
				$data[$ctr] = $otherRespo;
				$ctr++;
			}//end while loop
			return $data;
		}
		
		function FancyTable($header,$data)
		{
		    //Colors, line width and bold font
		    $this->SetFillColor(255,0,0);
		    $this->SetTextColor(255);
		    $this->SetDrawColor(128,0,0);
		    $this->SetLineWidth(.3);
		    $this->SetFont('','B');
		    //Header
		    $w=array(40,35,40,45);
		    for($i=0;$i<count($header);$i++)
		        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		    $this->Ln();
		    //Color and font restoration
		    $this->SetFillColor(224,235,255);
		    $this->SetTextColor(0);
		    $this->SetFont('');
		    //Data
		    $fill=false;
		    
		    for($row=0;$row<$rowSize;$row++)
			 {				
				print($data[$row]);				
			 }
			 
		    /*foreach($data as $row)
		    {
		        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
		        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		        $this->Ln();
		        $fill=!$fill;
		    }*/
		    
		    $this->Cell(array_sum($w),0,'','T');
		}	
				
		
		function showData($data)
		{			
			$howManyRowsQuery = "SELECT COUNT(*) AS howMany FROM tblInstructor WHERE academic_unit_id = '$this->academicUnitId'";
			$howManyRowsResult = DBConnection::readFromDatabase($howManyRowsQuery);
			$howManyRowsResultRow = mysql_fetch_object($howManyRowsResult);			 
			$rowSize = $howManyRowsResultRow->howMany;
			
			for($row=0;$row<$rowSize;$row++)
			{				
				print($data[$row]);				
			}
		}
		
	}//end class
	
	$pdf = new PDF();
	//Column titles
	$header=array('Instructor Id','First Name','Last Name','Email','Mobile Phone','Academic Rank','Service Year','Specialization','Other Resp.');
	//Data loading
	$data=$pdf->LoadData();
	$pdf->SetFont('Arial','',14);
	$pdf->FancyTable($header,$data);
	//$pdf->showData($data);
	$pdf->SetFont('Arial','',14);
	$pdf->Output();
?>
