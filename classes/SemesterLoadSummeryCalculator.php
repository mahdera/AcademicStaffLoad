<?php
	/*
		this php file will compute the loads on the fly.
	*/
	include_once('DBConnection.php');
	include_once('SemesterLoadSummery.php');	
	include_once('Semester.php');
	include_once('RateLookUp.php');
	include_once('FloatAdder.php');
	include_once('Instructor.php');	
	include_once('ExpectedTeachingCommitment.php');
	include_once('ExpectedTeachingCommitmentRateLookup.php');
	
	class SemesterLoadSummeryCalculator{
	
		public function SemesterLoadSummeryCalculator(){
		}
		
		public static function calculateSemesterLoadForThisFullTimerInstructor($instructorId)
		{
			$normalCourseLoad = 12.0;
			
			$instructorResultRow = Instructor::getInstructorDetail($instructorId);
			$fullName = $instructorResultRow->first_name." ".$instructorResultRow->last_name;
			//$additionalRespFK
			//continue from here!
		}
		
		public static function calculateSemesterLoadForFullTimerInstructor($academicUnitId)
		{
			$normalCourseLoad = 12.0;
			$query = "SELECT * FROM tblInstructor, tblInstructorLoad WHERE tblInstructor.academic_unit_id = '$academicUnitId' AND tblInstructor.instructor_id = tblInstructorLoad.instructor_id";
			
			//print("q is: $query");//passed
			
			$resultInstructors = DBConnection::readFromDatabase($query);
			
			//clear up the previously stored shit before saving the new calculated data value
			SemesterLoadSummery::deleteAllSemesterLoadSummery($academicUnitId);
			
			while($resultInstructorsRow = mysql_fetch_object($resultInstructors))//for each full timer instructor of the department
			{
				//$normalCourseLoad = 12.0;
				$instructorId = $resultInstructorsRow->instructor_id;
				//now i can determine if this particular instructor is committed some hour etc....from the expected teaching committemnt table
				if(ExpectedTeachingCommitment::doesThisInstructorFromThisAcademicUnitHasTeachingCommitment($instructorId,$academicUnitId) == "true")
				{
					//print($instructorId." has commit");
					$expectedTeachingCommitmentObj = ExpectedTeachingCommitment::getExpectedTeachingCommitmentFor($instructorId,$academicUnitId);					
					$expectedTeachingCommitmentRateLookupObj = ExpectedTeachingCommitmentRateLookup::getExpectedTeachingCommitmentRateLookup($expectedTeachingCommitmentObj->expected_teaching_commitment_rate_lookup_id);
					$normalCourseLoad = $expectedTeachingCommitmentRateLookupObj->expected_hour;
					//print("$normalCourseLoad<br/>");
				}
				$fullName = $resultInstructorsRow->first_name." ".$resultInstructorsRow->last_name;
				//print($fullName);passed
				$additionalRespoFK = $resultInstructorsRow->other_responsibilities;
				//now read the credit value for the additional responsibility of this instructor
				$queryEquivCredit = "SELECT * FROM tblAdminPosition WHERE id = $additionalRespoFK";
				//print("q for credit waiver: $queryEquivCredit");
				$queryEquivResult = DBConnection::readFromDatabase($queryEquivCredit);
				$queryEquivResultRow = mysql_fetch_object($queryEquivResult);
				$additionalResponsibilityEquivalentCredit = $queryEquivResultRow->equivalent_credit;
				//now modify the normal course load for the non-Ethiopians
				$nationality = trim($resultInstructorsRow->nationality);
				 
				if($nationality != "Ethiopian" && ExpectedTeachingCommitment::doesThisInstructorFromThisAcademicUnitHasTeachingCommitment($instructorId,$academicUnitId) == "true"){
					$expectedTeachingCommitmentObj = ExpectedTeachingCommitment::getExpectedTeachingCommitmentFor($instructorId,$academicUnitId);					
					$expectedTeachingCommitmentRateLookupObj = ExpectedTeachingCommitmentRateLookup::getExpectedTeachingCommitmentRateLookup($expectedTeachingCommitmentObj->expected_teaching_commitment_rate_lookup_id);
					$normalCourseLoad = $expectedTeachingCommitmentRateLookupObj->expected_hour;
					$normalCourseLoad = ($normalCourseLoad * 16) / 12;
				} 					
				else{
					if($nationality != "Ethiopian")
						  $normalCourseLoad = 16.0;
				}
							
				/*else
					$normalCourseLoad = 12.0;*/
					
				$expectedSemesterLoad = ($normalCourseLoad - $additionalResponsibilityEquivalentCredit);
				if($expectedSemesterLoad <= 0){
					$expectedSemesterLoad =0;
					//$additionalResponsibilityEquivalentCredit = 12;
				}
				
				//now look for information about the undergradCourse load for this particular instructor
				$queryUnder = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'UG' AND type != 'Project Advising' AND academic_unit_id = '$academicUnitId'";
				//print("udergradcourseload info: $queryUnder<br/>");passed
				$resultUnder = DBConnection::readFromDatabase($queryUnder);
				$undergradCourseLoad = 0.0;
				$undergradLecHour = 0.0;
				$undergradLabHour = 0.0;
				$undergradTutorialHour = 0.0;
				$undergradTutorialNumberOfSections=0.0;
				$undergradLabNumberOfSections=0.0;
				$udergradLecNumberOfSections=0.0;
				$undergradLecLoad = 0.0;
				$undergradLabLoad = 0.0;
				$undergradTutorialLoad = 0.0;
				$postgradLabLoad = 0.0;
				$postgradLecLoad = 0.0;
				$postgradTutorialLoad = 0.0;
				$postgradSeminarLoad = 0.0;
				
				
				ini_set('precision','14');
				$ugLabRate = floatval(RateLookup::getTheRate("UG","Lab"));				
				$ugLecRate = floatval(RateLookUp::getTheRate("UG","Lecture"));					
				$ugTutRate = floatval(RateLookUp::getTheRate("UG","Tutorial"));				
				
				
					while($resultUnderRow = mysql_fetch_object($resultUnder))//for each undergrad course of this instructor
					{
						$courseNumber = $resultUnderRow->course_number;
						
						$queryUndergradCourseDetail = "SELECT * FROM tblCourseOfferings WHERE course_number = '$courseNumber'";
						
						$resultUndergradCourseDetail = DBConnection::readFromDatabase($queryUndergradCourseDetail);
						$resultUndergradCourseDetailRow = mysql_fetch_object($resultUndergradCourseDetail);
						$ugRateLookupObj = RateLookUp::getRateLookupForThisCategoryAndDeliveryType("UG",$resultUnderRow->type);
						
						
						if($resultUnderRow->type == "Lecture"){
							$undergradLecHour = $resultUndergradCourseDetailRow->lecture_hour;//all the lec hrs spent by this specific instructor
							$udergradLecNumberOfSections = $resultUnderRow->number_of_sections;//all total sections given lec by this instructor
							$undergradLecLoad += $udergradLecNumberOfSections * $ugLecRate * $undergradLecHour; 							
						}else if($resultUnderRow->type == "Lab"){						
							$undergradLabHour = $resultUndergradCourseDetailRow->lab_hour;
							$undergradLabNumberOfSections = $resultUnderRow->number_of_sections;
							$undergradLabLoad += $undergradLabNumberOfSections * $ugLabRate * $undergradLabHour;
						}else if($resultUnderRow->type == "Tutorial"){							
							$undergradTutorialHour = $resultUndergradCourseDetailRow->tutorial_hour;
							$undergradTutorialNumberOfSections = $resultUnderRow->number_of_sections;
							$undergradTutorialLoad += $undergradTutorialNumberOfSections * $ugTutRate * $undergradTutorialHour;
						}						
					}//end undergrad load calc while...loop
					
									
					
					//now sum'em up
					$undergradCourseLoad = $undergradLecLoad + $undergradLabLoad + $undergradTutorialLoad;
					$undergradLecLoad=0.0;
					$undergradLabLoad=0.0;
					$undergradTutorialLoad=0.0;					
					
					
					//now look for info about the course given at the post grad level by this particular instructor
					$queryPost = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'PG' AND type != 'Project Advising' AND type != 'Thesis' AND academic_unit_id = '$academicUnitId'";
					$resultPost = DBConnection::readFromDatabase($queryPost);
					$postgradCourseLoad = 0.0;
					$postgradLecHour = 0.0;
					$postgradLabHour = 0.0;
					$postgradTutorialHour = 0.0;
					$postgradTutorialNumberOfSections=0.0;
					$postgradLabNumberOfSections=0.0;
					$postgradLecNumberOfSections=0.0;
					
					//$pgLecRate = floatval(RateLookUp::getTheRate("PG","Lecture"));//1.5;//RateLookUp::getTheRate("PG","Lecture");
					//$pgLabRate = floatval(RateLookUp::getTheRate("PG","Lab"));//1.25;//RateLookUp::getTheRate("PG","Lab");
					//$pgTutorialRate = floatval(RateLookUp::getTheRate("PG","Tutorial"));//0.75;
				
					while($resultPostRow = mysql_fetch_object($resultPost))//for each course in category PG given by this particular instructor
					{
						$pgRateLookupObj = RateLookUp::getRateLookupForThisCategoryAndDeliveryType("PG",$resultPostRow->type);
						$courseNumber = $resultPostRow->course_number;
						//$numberOfSections = $resultPostRow->number_of_sections;						
						$queryPostgradCourseDetail = "SELECT * FROM tblCourseOfferings WHERE course_number = '$courseNumber'";
						//print($queryPostgradCourseDetail."<br/>");
						$resultPostgradCourseDetail = DBConnection::readFromDatabase($queryPostgradCourseDetail);
						$resultPostgradCourseDetailRow = mysql_fetch_object($resultPostgradCourseDetail);
						
						if($resultPostRow->type == "Lecture"){							
							$postgradLecHour = $resultPostgradCourseDetailRow->lecture_hour;
							$numberOfValues = 0.0;
							if($pgRateLookupObj->calculating_mechanism == "student"){
								$numberOfValues = $resultPostRow->number_of_students;
							}else if($pgRateLookupObj->calculating_mechanism == "section"){
								$numberOfValues = $resultPostRow->number_of_sections;
							}
							//$postgradLecNumberOfSections = $resultPostRow->number_of_sections;
							$postgradLecLoad += $numberOfValues * $pgRateLookupObj->rate * $postgradLecHour;
						}else if($resultPostRow->type == "Lab"){
							$postgradLabHour = $resultPostgradCourseDetailRow->lab_hour;
							if($pgRateLookupObj->calculating_mechanism == "student"){
								$numberOfValues = $resultPostRow->number_of_students;
							}else if($pgRateLookupObj->calculating_mechanism == "section"){
								$numberOfValues = $resultPostRow->number_of_sections;
							}
							//$postgradLabNumberOfSections = $resultPostRow->number_of_sections;
							$postgradLabLoad += $numberOfValues * $pgRateLookupObj->rate * $postgradLabHour;
						}else if($resultPostRow->type == "Tutorial"){
							$postgradTutorialHour = $resultPostgradCourseDetailRow->tutorial_hour;
							if($pgRateLookupObj->calculating_mechanism == "student"){
								$numberOfValues = $resultPostRow->number_of_students;
							}else if($pgRateLookupObj->calculating_mechanism == "section"){
								$numberOfValues = $resultPostRow->number_of_sections;
							}
							//$postgradTutorialNumberOfSections = $resultPostRow->number_of_sections;
							$postgradTutorialLoad += $numberOfValues * $pgRateLookupObj->rate * $postgradTutorialHour;
						}else if($resultPostRow->type == "Seminar"){
							if($pgRateLookupObj->calculating_mechanism == "student"){
								$numberOfValues = $resultPostRow->number_of_students;
							}else if($pgRateLookupObj->calculating_mechanism == "section"){
								$numberOfValues = $resultPostRow->number_of_sections;
							}
							$postgradSeminarLoad += $numberOfValues * $pgRateLookupObj->rate;
						}
					}//end postgrad load calc while...loop					
					
					
					
					//now sum'em up
					$postgradCourseLoad = $postgradLecLoad + $postgradLabLoad + $postgradTutorialLoad + $postgradSeminarLoad;
					$postgradLecLoad = 0.0;
					$postgradLabLoad = 0.0;
					$postgradTutorialLoad = 0.0;
					$postgradSeminarLoad = 0.0;
					//now multiply this info by the number of sections					
					$ugAdvisingRate = floatval(RateLookUp::getTheRate("UG","Project Advising"));
				//now do for undergrad advising case
				$queryUndergradAdvising = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'UG' AND type = 'Project Advising' AND academic_unit_id = '$academicUnitId'";
				//print($queryUndergradAdvising."<br/>");
				$resultUndergradAdvising = DBConnection::readFromDatabase($queryUndergradAdvising);
				$undergradAdvisingLoad = 0.0;
				
				while($resultUndergradAdvisingRow = mysql_fetch_object($resultUndergradAdvising))
				{
					$numberOfStudents = $resultUndergradAdvisingRow->number_of_students;
					$undergradAdvisingLoad += $numberOfStudents * $ugAdvisingRate;
					//print("ug advising: $undergradAdvisingLoad<br/>");
				}//end undergrad advising load calc while...loop
				//if($instructorId == "12345")
					//print("for UG Advising : ".$numberOfStudents."<br/>");
					
				//now do the same for MSc project load calculation
				$queryMscProjectAdvising = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'PG' AND type = 'Project Advising' AND academic_unit_id = '$academicUnitId'";
				$resultMscProjectAdvising = DBConnection::readFromDatabase($queryMscProjectAdvising);
				$mscProjectAdvisingLoad = 0.0;
				$pgAdvisingRate = floatval(RateLookUp::getTheRate("PG","Project Advising"));
				//print("the proj ad rate for PG : $pgAdvisingRate");
				
				while($resultMscProjectAdvisingRow = mysql_fetch_object($resultMscProjectAdvising))
				{
					$numberOfStudents = $resultMscProjectAdvisingRow->number_of_students;
					$mscProjectAdvisingLoad += $numberOfStudents * $pgAdvisingRate;
					//print("pg project advising: $mscProjectAdvisingLoad<br/>");
				}//end postgrad msc proj advising load calc while...loop
					
			  	//now do the same for thesis load calculation
			  	$queryThesisAdvising = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'PG' AND type = 'Thesis' AND academic_unit_id = '$academicUnitId'";
			  	$resultThesisAdvising = DBConnection::readFromDatabase($queryThesisAdvising);
			  	$thesisAdvisingLoad = 0.0;
			  	$numberOfStudents = 0.0;
			  	
				$thesisAdvisingRate = floatval(RateLookUp::getTheRate("PG","Thesis"));
			  	
				while($resultThesisAdvisingRow = mysql_fetch_object($resultThesisAdvising))
				{
					$numberOfStudents = floatval($resultThesisAdvisingRow->number_of_students);
					//print("num of stud is : $numberOfStudents : <br/>");
					$thesisAdvisingLoad += (floatval($numberOfStudents) * $thesisAdvisingRate);
				}//end thesis advising load calc while...loop
				
				$queryPhdPrincipalAdvising = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'PhD' AND type = 'Principal PhD Advisor' AND academic_unit_id = '$academicUnitId'";
			  	$resultPhdPrincipalAdvising = DBConnection::readFromDatabase($queryPhdPrincipalAdvising);
			  	$phDPrincipalAdvisingLoad = 0.0;
			  	$numberOfStudents = 0.0;
				
				$phdPrincipalAdvisingRate = floatval(RateLookup::getTheRate("PhD", "Principal PhD Advisor"));
				while($resultPhdPrincipalAdvisingRow = mysql_fetch_object($resultPhdPrincipalAdvising))
				{
					$numberOfStudents = floatval($resultPhdPrincipalAdvisingRow->number_of_students);					
					$phDPrincipalAdvisingLoad += (floatval($numberOfStudents) * $phdPrincipalAdvisingRate);
				}//end thesis advising load calc while...loop
				
				$queryPhdCoAdvising = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'PhD' AND type = 'PhD Co-Advisor' AND academic_unit_id = '$academicUnitId'";
			  	$resultPhdCoAdvising = DBConnection::readFromDatabase($queryPhdCoAdvising);
			  	$phDCoAdvisingLoad = 0.0;
			  	$numberOfStudents = 0.0;
				
				$phdCoAdvisingRate = floatval(RateLookup::getTheRate("PhD", "PhD Co-Advisor"));
				while($queryPhdCoAdvisingRow = mysql_fetch_object($resultPhdCoAdvising))
				{
					$numberOfStudents = floatval($queryPhdCoAdvisingRow->number_of_students);					
					$phDCoAdvisingLoad += (floatval($numberOfStudents) * $phdCoAdvisingRate);
				}//end thesis advising load calc while...loop
			  		
			  	//now sum up all the needed info for this particular instructor
			  	//print("postprojadvising: $mscProjectAdvisingLoad<br/>");
			  	$totalAdvisingLoad = $undergradAdvisingLoad + $mscProjectAdvisingLoad + $thesisAdvisingLoad + $phDPrincipalAdvisingLoad + $phDCoAdvisingLoad;
			  	$totalCourseLoad = $undergradCourseLoad + $postgradCourseLoad;
			  	$totalSemesterLoad = 0.0;
			  	$totalSemesterLoad = floatval($totalCourseLoad) + floatval($totalAdvisingLoad);			  	
			  	
			  	$semesterExcessLoad = $totalSemesterLoad - $expectedSemesterLoad;
			  	
			  	//now i have everything i want to save to the database.
			  	//create an instance from the SemesterLoadSummery class
			  	//mock the semester and the year for testing purpose;
			  	//get the semester and the academic year from the database where the admin has eneterd
			  	$semesterRow = Semester::getCurrentSemester();
			  	$semester = $semesterRow->semester;
			  	$year = $semesterRow->academic_year;
			  	
				$semesterLoadSummeryObj = new SemesterLoadSummery($instructorId,$semester,$year,$fullName,$academicUnitId,$normalCourseLoad,$additionalResponsibilityEquivalentCredit,$expectedSemesterLoad,$undergradCourseLoad,$postgradCourseLoad, $undergradAdvisingLoad,$mscProjectAdvisingLoad,$thesisAdvisingLoad,$totalAdvisingLoad, $totalSemesterLoad,$semesterExcessLoad);
				
				//since this is done for all the instructors of the given department, i should do the deletion in here				
				$semesterLoadSummeryObj->addSemesterLoadSummery();				
			}//end for each fulltimer instructor while...loop
		}//end calcSemesterLoadSummery method
		
		
		
		public static function calculateSemesterLoadForPartTimerInstructor($academicUnitId)
		{
			$normalCourseLoad = 6.0;
			$query = "SELECT * FROM tblParttimer, tblInstructorLoad WHERE tblParttimer.academic_unit_id = '$academicUnitId' AND tblParttimer.parttimer_id = tblInstructorLoad.instructor_id";
			
			//print("q is: $query");//passed
			
			$resultParttimerInstructors = DBConnection::readFromDatabase($query);
			
			//clear up the previously stored shit before saving the new calculated data value
			//SemesterLoadSummery::deleteAllSemesterLoadSummery($academicUnitId);
			
			while($resultInstructorsRow = mysql_fetch_object($resultParttimerInstructors))//for each full timer instructor of the department
			{
				$instructorId = $resultInstructorsRow->parttimer_id;
				//print($instructorId);//passed				
				$fullName = $resultInstructorsRow->first_name." ".$resultInstructorsRow->last_name;				
				$expectedSemesterLoad = $normalCourseLoad;//12;//this value is an expected semester load for parttimers
				//print($expectedSemesterLoad);passed
				//now look for information about the undergradCourse load for this particular instructor
				
				$queryUnder = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'UG' AND type != 'Project Advising' AND academic_unit_id = '$academicUnitId'";
				//print("udergradcourseload info: $queryUnder<br/>");
				//print("mahder");
				$resultUnder = DBConnection::readFromDatabase($queryUnder);
				$undergradCourseLoad = 0.0;
				$undergradLecHour = 0.0;
				$undergradLabHour = 0.0;
				$undergradTutorialHour = 0.0;
				$undergradTutorialNumberOfSections=0.0;
				$undergradLabNumberOfSections=0.0;
				$udergradLecNumberOfSections=0.0;
				$undergradLecLoad = 0.0;
				$undergradLabLoad = 0.0;
				$undergradTutorialLoad = 0.0;
				$postgradLabLoad = 0.0;
				$postgradLecLoad = 0.0;
				$postgradTutorialLoad = 0.0;			
				
				ini_set('precision','14');
				$ugLabRate = floatval(RateLookup::getTheRate("UG","Lab"));				
				$ugLecRate = floatval(RateLookUp::getTheRate("UG","Lecture"));					
				$ugTutRate = floatval(RateLookUp::getTheRate("UG","Tutorial"));
				
				
					while($resultUnderRow = mysql_fetch_object($resultUnder))//for each undergrad course of this instructor
					{
						$courseNumber = $resultUnderRow->course_number;
						
						$queryUndergradCourseDetail = "SELECT * FROM tblCourseOfferings WHERE course_number = '$courseNumber'";
						//print("undergrad course detail: $queryUndergradCourseDetail<br/>");//passed
						$resultUndergradCourseDetail = DBConnection::readFromDatabase($queryUndergradCourseDetail);
						$resultUndergradCourseDetailRow = mysql_fetch_object($resultUndergradCourseDetail);
						//print("course type: $resultUnderRow->type<br/>");passed
						if($resultUnderRow->type == "Lecture")
						{
							$undergradLecHour = $resultUndergradCourseDetailRow->lecture_hour;//all the lec hrs spent by this specific instructor
							$udergradLecNumberOfSections = $resultUnderRow->number_of_sections;//all total sections given lec by this instructor
							$undergradLecLoad += $udergradLecNumberOfSections * $ugLecRate * $undergradLecHour; 							
						}
						else if($resultUnderRow->type == "Lab")
						{							
							//$undergradLabHour += $resultUndergradCourseDetailRow->lab_hour;
							//$undergradLabNumberOfSections += $resultUnderRow->number_of_sections;							
							//print("undergrad lab hr: $undergradLabHour<br/>");//there is no print value for this case
							$undergradLabHour = $resultUndergradCourseDetailRow->lab_hour;
							$undergradLabNumberOfSections = $resultUnderRow->number_of_sections;
							$undergradLabLoad += $undergradLabNumberOfSections * $ugLabRate * $undergradLabHour;
						}	
						else if($resultUnderRow->type == "Tutorial")
						{
							//$undergradTutorialHour += $resultUndergradCourseDetailRow->tutorial_hour;
							//$undergradTutorialNumberOfSections += $resultUnderRow->number_of_sections;
							$undergradTutorialHour = $resultUndergradCourseDetailRow->tutorial_hour;
							$undergradTutorialNumberOfSections = $resultUnderRow->number_of_sections;
							$undergradTutorialLoad += $undergradTutorialNumberOfSections * $ugTutRate * $undergradTutorialHour;
						}					
					}//end undergrad load calc while...loop
					
					
					
					//$totalUndergradLecLoad = ($undergradLecHour * $udergradLecNumberOfSections * $ugLecRate);										
					//$totalUndergradLabHour = ($undergradLabHour * $undergradLabNumberOfSections * $ugLabRate);
					//$totalUndergradTutorialHour *= ($undergradTutorialHour * $undergradTutorialNumberOfSections * $ugTutRate);
					
					//now sum'em up
					$undergradCourseLoad = $undergradLecLoad + $undergradLabLoad + $undergradTutorialLoad;
					$undergradLecLoad=0.0;
					$undergradLabLoad=0.0;
					$undergradTutorialLoad=0.0;					
					
				//now look for info about the course given at the post grad level by this particular instructor
				$queryPost = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'PG' AND type != 'Project Advising' AND type != 'Thesis' AND academic_unit_id = '$academicUnitId'";
				//print($queryPost);//passed
				$resultPost = DBConnection::readFromDatabase($queryPost);
				$postgradCourseLoad = 0.0;
				$postgradLecHour = 0.0;
				$postgradLabHour = 0.0;
				$postgradTutorialHour = 0.0;
				$postgradTutorialNumberOfSections=0.0;
				$postgradLabNumberOfSections=0.0;
				$postgradLecNumberOfSections=0.0;
				$pgLecRate = floatval(RateLookUp::getTheRate("PG","Lecture"));//1.5;//RateLookUp::getTheRate("PG","Lecture");
				$pgLabRate = floatval(RateLookUp::getTheRate("PG","Lab"));//1.25;//RateLookUp::getTheRate("PG","Lab");
				$pgTutorialRate = floatval(RateLookUp::getTheRate("PG","Tutorial"));//0.75;
				
					while($resultPostRow = mysql_fetch_object($resultPost))//for each course in category PG given by this particular instructor
					{
						$pgRateLookupObj = RateLookUp::getRateLookupForThisCategoryAndDeliveryType("PG",$resultPostRow->type);
						$courseNumber = $resultPostRow->course_number;
						//$numberOfSections = $resultPostRow->number_of_sections;						
						$queryPostgradCourseDetail = "SELECT * FROM tblCourseOfferings WHERE course_number = '$courseNumber'";
						//print($queryPostgradCourseDetail."<br/>");
						$resultPostgradCourseDetail = DBConnection::readFromDatabase($queryPostgradCourseDetail);
						$resultPostgradCourseDetailRow = mysql_fetch_object($resultPostgradCourseDetail);
						
						if($resultPostRow->type == "Lecture")
						{							
							$postgradLecHour = $resultPostgradCourseDetailRow->lecture_hour;
							//$postgradLecNumberOfSections = $resultPostRow->number_of_sections;
							if($pgRateLookupObj->calculating_mechanism == "student"){
								$numberOfValues = $resultPostRow->number_of_students;
							}else if($pgRateLookupObj->calculating_mechanism == "section"){
								$numberOfValues = $resultPostRow->number_of_sections;
							}
							$postgradLecLoad += $numberOfValues * $pgRateLookupObj->rate * $postgradLecHour;
						}
						else if($resultPostRow->type == "Lab")
						{
							$postgradLabHour = $resultPostgradCourseDetailRow->lab_hour;
							//$postgradLabNumberOfSections = $resultPostRow->number_of_sections;
							if($pgRateLookupObj->calculating_mechanism == "student"){
								$numberOfValues = $resultPostRow->number_of_students;
							}else if($pgRateLookupObj->calculating_mechanism == "section"){
								$numberOfValues = $resultPostRow->number_of_sections;
							}
							$postgradLabLoad += $numberOfValues * $pgRateLookupObj->rate * $postgradLabHour;
						}
						else if($resultPostRow->type == "Tutorial")
						{
							$postgradTutorialHour = $resultPostgradCourseDetailRow->tutorial_hour;
							//$postgradTutorialNumberOfSections = $resultPostRow->number_of_sections;
							if($pgRateLookupObj->calculating_mechanism == "student"){
								$numberOfValues = $resultPostRow->number_of_students;
							}else if($pgRateLookupObj->calculating_mechanism == "section"){
								$numberOfValues = $resultPostRow->number_of_sections;
							}
							$postgradTutorialLoad += $numberOfValues * $pgRateLookupObj->rate * $postgradTutorialHour;
						}else if($resultPostRow->type == "Seminar"){
							if($pgRateLookupObj->calculating_mechanism == "student"){
								$numberOfValues = $resultPostRow->number_of_students;
							}else if($pgRateLookupObj->calculating_mechanism == "section"){
								$numberOfValues = $resultPostRow->number_of_sections;
							}
							$postgradSeminarLoad += $numberOfValues * $pgRateLookupObj->rate;
						}						
					}//end postgrad load calc while...loop					
					
					
					
					//now sum'em up
					$postgradCourseLoad = $postgradLecLoad + $postgradLabLoad + $postgradTutorialLoad + $postgradSeminarLoad;
					$postgradLecLoad = 0.0;
					$postgradLabLoad = 0.0;
					$postgradTutorialLoad = 0.0;
					$postgradSeminarLoad = 0.0;
					//now multiply this info by the number of sections					
					$ugAdvisingRate = floatval(RateLookUp::getTheRate("UG","Project Advising"));
				//now do for undergrad advising case
				$queryUndergradAdvising = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'UG' AND type = 'Project Advising' AND academic_unit_id = '$academicUnitId'";
				//print($queryUndergradAdvising."<br/>");
				$resultUndergradAdvising = DBConnection::readFromDatabase($queryUndergradAdvising);
				$undergradAdvisingLoad = 0.0;
				
				while($resultUndergradAdvisingRow = mysql_fetch_object($resultUndergradAdvising))
				{
					$numberOfStudents = $resultUndergradAdvisingRow->number_of_students;
					$undergradAdvisingLoad = $numberOfStudents * $ugAdvisingRate;
					//print("ug advising: $undergradAdvisingLoad<br/>");
				}//end undergrad advising load calc while...loop
					
				//now do the same for MSc project load calculation
				$queryMscProjectAdvising = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'PG' AND type = 'Project Advising' AND academic_unit_id = '$academicUnitId'";
				$resultMscProjectAdvising = DBConnection::readFromDatabase($queryMscProjectAdvising);
				$mscProjectAdvisingLoad = 0.0;
				$pgAdvisingRate = floatval(RateLookUp::getTheRate("PG","Project Advising"));
				
					while($resultMscProjectAdvisingRow = mysql_fetch_object($resultMscProjectAdvising))
					{
						$numberOfStudents = $resultMscProjectAdvisingRow->number_of_students;
						$mscProjectAdvisingLoad = $numberOfStudents * $pgAdvisingRate;
						//print("pg project advising: $mscProjectAdvisingLoad<br/>");
					}//end postgrad msc proj advising load calc while...loop
					
			  	//now do the same for thesis load calculation
			  	$queryThesisAdvising = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'PG' AND type = 'Thesis' AND academic_unit_id = '$academicUnitId'";
			  	$resultThesisAdvising = DBConnection::readFromDatabase($queryThesisAdvising);
			  	$thesisAdvisingLoad = 0.0;
				$thesisAdvisingRate = floatval(RateLookUp::getTheRate("PG","Thesis"));
			  	
				while($resultThesisAdvisingRow = mysql_fetch_object($resultThesisAdvising))
				{
					$numberOfStudents = $resultThesisAdvisingRow->number_of_students;
					$thesisAdvisingLoad = $numberOfStudents * $thesisAdvisingRate;
				}//end thesis advising load calc while...loop
				
				$queryPhdPrincipalAdvising = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'PhD' AND type = 'Principal PhD Advisor' AND academic_unit_id = '$academicUnitId'";
			  	$resultPhdPrincipalAdvising = DBConnection::readFromDatabase($queryPhdPrincipalAdvising);
			  	$phDPrincipalAdvisingLoad = 0.0;
			  	$numberOfStudents = 0.0;
				
				$phdPrincipalAdvisingRate = floatval(RateLookup::getTheRate("PhD", "Principal PhD Advisor"));
				while($resultPhdPrincipalAdvisingRow = mysql_fetch_object($resultPhdPrincipalAdvising))
				{
					$numberOfStudents = floatval($resultPhdPrincipalAdvisingRow->number_of_students);					
					$phDPrincipalAdvisingLoad += (floatval($numberOfStudents) * $phdPrincipalAdvisingRate);
				}//end thesis advising load calc while...loop
				
				$queryPhdCoAdvising = "SELECT * FROM tblInstructorLoad WHERE instructor_id = '$instructorId' AND category = 'PhD' AND type = 'PhD Co-Advisor' AND academic_unit_id = '$academicUnitId'";
			  	$resultPhdCoAdvising = DBConnection::readFromDatabase($queryPhdCoAdvising);
			  	$phDCoAdvisingLoad = 0.0;
			  	$numberOfStudents = 0.0;
				
				$phdCoAdvisingRate = floatval(RateLookup::getTheRate("PhD", "PhD Co-Advisor"));
				while($queryPhdCoAdvisingRow = mysql_fetch_object($resultPhdCoAdvising))
				{
					$numberOfStudents = floatval($queryPhdCoAdvisingRow->number_of_students);					
					$phDCoAdvisingLoad += (floatval($numberOfStudents) * $phdCoAdvisingRate);
				}//end thesis advising load calc while...loop
			  		
			  	//now sum up all the needed info for this particular instructor
			  	//print("postprojadvising: $mscProjectAdvisingLoad<br/>");
			  	$totalAdvisingLoad = $undergradAdvisingLoad + $mscProjectAdvisingLoad + $thesisAdvisingLoad + $phDPrincipalAdvisingLoad + $phDCoAdvisingLoad;
			  	$totalCourseLoad = $undergradCourseLoad + $postgradCourseLoad;
			  	$totalSemesterLoad = 0.0;
			  	$totalSemesterLoad = floatval($totalCourseLoad) + floatval($totalAdvisingLoad);
			  	//$totalSemesterLoad = 4.5+6.3;//FloatAdder::getSum($totalCourseLoad,$totalAdvisingLoad);
			  	
			  	/*print("<p>");
			  		print("$instructorId : $totalSemesterLoad<br/>");
			  		print("Advising only : $totalAdvisingLoad<br/>");
			  		print("Course only : $totalCourseLoad<br/>");
			  		print("Summing'em will give : ($totalAdvisingLoad + $totalCourseLoad) = ");
			  	print("</p>");*/
			  	
			  	$semesterExcessLoad = $totalSemesterLoad - $expectedSemesterLoad;
			  	
			  	//now i have everything i want to save to the database.
			  	//create an instance from the SemesterLoadSummery class
			  	//mock the semester and the year for testing purpose;
			  	//get the semester and the academic year from the database where the admin has eneterd
			  	$semesterRow = Semester::getCurrentSemester();
			  	$semester = $semesterRow->semester;
			  	$year = $semesterRow->academic_year;
			  	
			  	$additionalResponsibilityEquivalentCredit = 0;
				$semesterLoadSummeryObj = new SemesterLoadSummery($instructorId,$semester,$year,$fullName,$academicUnitId,$normalCourseLoad,$additionalResponsibilityEquivalentCredit,$expectedSemesterLoad,$undergradCourseLoad,$postgradCourseLoad, $undergradAdvisingLoad,$mscProjectAdvisingLoad,$thesisAdvisingLoad,$totalAdvisingLoad, $totalSemesterLoad,$semesterExcessLoad);
				//checking all the parameters
				/*print("Checking parameters values in the SemesterLoadSummerCalculator::calculateSemesterLoadForFullTimerInstructor()<br/>");
				print("====================================<br/>");
				print("Instructor Id: $instructorId<br/>");
				print("Semester: $semester<br/>");
				print("Year: $year<br/>");
				print("Full Name: <u>$fullName</u><br/>");
				print("Academic Unit Id: $academicUnitId<br/>");
				print("Normal load: $normalCourseLoad<br/>");
				print("Additional Responsibility Waiver: $additionalResponsibilityEquivalentCredit<br/>");
				print("Expected Course Load: $expectedSemesterLoad<br/>");
				print("Undergrad Course Load: $undergradCourseLoad<br/>");
				print("Postgrad Course Load: $postgradCourseLoad<br/>");
				print("Undergrad Advising Load: $undergradAdvisingLoad<br/>");
				print("Postgrad Project Advising: $mscProjectAdvisingLoad<br/>");
				print("Thesis Advising Load: $thesisAdvisingLoad<br/>");
				print("Total Advising Load: $totalAdvisingLoad<br/>");
				print("Total Semester Load: $totalSemesterLoad<br/>");
				print("Semester Excess Load: $semesterExcessLoad<br/>");
				print("--------------------------------<br/>");*/
				//since this is done for all the instructors of the given department, i should do the deletion in here				
				$semesterLoadSummeryObj->addSemesterLoadSummery();				
			}//end for each fulltimer instructor while...loop
		}//end calcSemesterLoadSummery method
		
		public static function getTotalHourForThisCourse($category,$numberOfSections,$type){
			try{				
				$rate = RateLookUp::getTheRate($category,$type);
				$totalHour = ($rate * $numberOfSections);
				return $totalHour;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
	}//end class
?>