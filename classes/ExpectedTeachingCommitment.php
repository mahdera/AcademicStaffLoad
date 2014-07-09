<?php
	class ExpectedTeachingCommitment{
		private $id;
		private $instructorId;
		private $academicUnitId;
		private $expectedTeachingCommitmentRateLookupId;
		
		public function ExpectedTeachingCommitment($instructorId,$academicUnitId,$expectedTeachingCommitmentRateLookupId){
			$this->instructorId = $instructorId;
			$this->academicUnitId = $academicUnitId;
			$this->expectedTeachingCommitmentRateLookupId = $expectedTeachingCommitmentRateLookupId;
		}
		
		public function setInstructorId($instructorId){
			$this->instructorId = $instructorId;
		}
		
		public function getInstructorId(){
			return $this->instructorId;
		}
		
		public function setAcademicUnitId($academicUnitId){
			$this->academicUnitId = $academicUnitId;
		}
		
		public function getAcademicUnitId(){
			return $this->academicUnitId;
		}
		
		public function setExpectedTeachingCommitmentRateLookupId($expectedTeachingCommitmentRateLookupId){
			$this->expectedTeachingCommitmentRateLookupId = $expectedTeachingCommitmentRateLookupId;
		}
		
		public function getExpectedTeachingCommitmentRateLookupId(){
			return $this->expectedTeachingCommitmentRateLookupId;
		}
		
		public function addExpectedTeachingCommitment(){
			try{
				$query = "INSERT INTO tblExpectedTeachingCommitment VALUES(0,'$this->instructorId','$this->academicUnitId',$this->expectedTeachingCommitmentRateLookupId)";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteExpectedTeachingCommitment($id){
			try{
				$query = "DELETE FROM tblExpectedTeachingCommitment WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateExpectedTeachingCommitment($id,$instructorId,$academicUnitId,$expectedTeachingCommitmentRateLookupId){
			try{
				$query = "UPDATE tblExpectedTeachingCommitment SET instructor_id = '$instructorId', academic_unit_id = '$academicUnitId', expected_teaching_commitment_rate_lookup_id = $expectedTeachingCommitmentRateLookupId WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateExpectedTeachingCommitmentForThisInstructor($commitmentValue,$instructorId,$academicUnitId){
			try{
				$query = "UPDATE tblExpectedTeachingCommitment SET expected_teaching_commitment_rate_lookup_id = $commitmentValue WHERE instructor_id='$instructorId' AND academic_unit_id='$academicUnitId'";
				//print($query);
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllExpectedTeachingCommitments(){
			try{
				$query = "SELETE * FROM tblExpectedTeachingCommitment ORDER BY academic_unit_id ASC";
				$result = DBConnection::executeQuery($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getExpectedTeachingCommitment($id){
			try{
				$query = "SELECT * FROM tblExpectedTeachingCommitment WHERE id = $id";
				$result = DBConnection::executeQuery($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getExpectedTeachingCommitmentFor($instructorId,$academicUnitId){
			try{
				$query = "SELECT * FROM tblExpectedTeachingCommitment WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId'";
				//print($query."<br/>");
				$result = DBConnection::executeQuery($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function doesThisInstructorFromThisAcademicUnitHasTeachingCommitment($instructorId,$academicUnitId){
			$doesHave = "false";
			try{
				$query = "SELECT COUNT(*) AS hasValue FROM tblExpectedTeachingCommitment WHERE instructor_id = '$instructorId' AND academic_unit_id = '$academicUnitId'";
				//print($query);
				$result = DBConnection::executeQuery($query);
				$resultRow = mysql_fetch_object($result);
				$hasValue = $resultRow->hasValue;
				if($hasValue != 0)
					$doesHave = "true";
				else
					$doesHave = "false";
			}catch(Exception $e){
				$e->__toString();
			}
			return $doesHave;
		}
	}//end class
?>