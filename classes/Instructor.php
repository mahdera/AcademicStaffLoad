<?php
	include_once("DBConnection.php");
	
	class Instructor{
		private $instructorId;
		private $firstName;
		private $lastName;
		private $email;
		private $mobilePhone;
		private $instuctorLevel;
		private $serviceYear;
		private $specialization;
		private $academicUnitId;
		private $otherResponsibility;
		//the following fileds are needed for the staff profiling
		private $sex;
		private $status;
		private $nationality;
		private $educationalQualification;
		
		public function Instructor($instructorId,$firstName,$lastName,$email,$mobilePhone,$instructorLevel,$serviceYear,$specialization,$academicUnitId,$otherResponsibility,$sex,$status,$nationality,$educationalQualification)
		{
			$this->setInstructorId($instructorId);
			$this->setFirstName($firstName);
			$this->setLastName($lastName);
			$this->setEmail($email);
			$this->setMobilePhone($mobilePhone);
			$this->setInstructorLevel($instructorLevel);
			$this->setServiceYear($serviceYear);
			$this->setSpecialization($specialization);
			$this->setAcademicUnitId($academicUnitId);
			$this->setOtherResponsibility($otherResponsibility);
			$this->setSex($sex);
			$this->setStatus($status);
			$this->setNationality($nationality);
			$this->setEducationalQualification($educationalQualification);
		}
		
		public function setSex($sex)
		{
			$this->sex = $sex;
		}
		
		public function setStatus($status)
		{
			$this->status = $status;
		}
		
		public function setNationality($nationality)
		{
			$this->nationality = $nationality;
		}
		
		public function setEducationalQualification($educationalQualification)
		{
			$this->educationalQualification = $educationalQualification;
		}			
		
		public function setOtherResponsibility($otherResponsibility)
		{
			$this->otherResponsibility = $otherResponsibility;
		}
		
		public function setServiceYear($serviceYear)
		{
			$this->serviceYear = $serviceYear;
		}
		
		public function setSpecialization($specialization)
		{
			$this->specialization = $specialization;
		}
		
		public function setInstructorId($instructorId)
		{
			$this->instructorId = $instructorId;
		}
		
		public function setFirstName($firstName)
		{
			$this->firstName = $firstName;
		}
		
		public function setLastName($lastName)
		{
			$this->lastName = $lastName;
		}
		
		public function setEmail($email)
		{
			$this->email = $email;
		}
		
		public function setMobilePhone($mobilePhone)
		{
			$this->mobilePhone = $mobilePhone;
		}
		
		public function setInstructorLevel($instructorLevel)
		{
			$this->instructorLevel = $instructorLevel;
		}
		
		public function setAcademicUnitId($academicUnitId)
		{
			$this->academicUnitId = $academicUnitId;
		}
		
		public function getSex()
		{
			return $this->sex;
		}
		
		public function getStatus()
		{
			return $this->status;
		}
		
		public function getNationality()
		{
			return $this->nationality;
		}
		
		public function getEducationalQualification()
		{
			return $this->educationalQualification;
		}
		
		public function getOtherResponsibility()
		{
			return $this->otherResponsibility;
		}
		
		public function getServiceYear()
		{
			return $this->serviceYear;
		}
		
		public function getSpecialization()
		{
			return $this->specialization;
		}
		
		public function getInstructorId()
		{
			return $this->instructorId;
		}
		
		public function getFirstName()
		{
			return $this->firstName;
		}	
		
		public function getLastName()
		{
			return $this->lastName;
		}
		
		public function getEmail()
		{
			return $this->email;
		}
		
		public function getMobilePhone()
		{
			return $this->mobilePhone;
		}
		
		public function getInstructorLevel()
		{
			return $this->instructorLevel;
		}
		
		public function getAcademicUnitId()
		{
			return $this->academicUnitId;
		}
		
		public function addInstructor()
		{
			try{
				$query = "INSERT INTO tblInstructor VALUES('$this->instructorId','$this->firstName','$this->lastName','$this->email','$this->mobilePhone','$this->instructorLevel',$this->serviceYear,'$this->specialization','$this->academicUnitId',$this->otherResponsibility,'$this->sex','$this->status','$this->nationality','$this->educationalQualification')";
				//print($query);
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteInstructor($instructorId)
		{
			try{
				$query = "DELETE FROM tblInstructor WHERE instructor_id = '$instructorId'";				
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateInstructor($instructorId,$firstName,$lastName,$email,$mobilePhone,$instructorLevel,$serviceYear,$spcialization,$academicUnitId,$otherResponsibility,$sex,$status,$nationality,$qualification)
		{
			try{
				$query = "UPDATE tblInstructor SET first_name = '$firstName', last_name = '$lastName', email = '$email', mobile_phone = '$mobilePhone', instructor_level = '$instructorLevel', service_year = $serviceYear, specialization = '$spcialization', academic_unit_id = '$academicUnitId', other_responsibilities = $otherResponsibility, sex = '$sex', status = '$status', nationality = '$nationality', educational_qualification = '$qualification' WHERE instructor_id = '$instructorId'";
				//print($query);
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getInstructorFullName($instId)
		{
			try{
				$query = "SELECT * FROM tblInstructor WHERE instructor_id = '$instId'";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllInstructorsInThisAcademicUnit($academicUnitId)
		{
			try{
				$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId'";
				//print($query);
				$instructorResult = DBConnection::readFromDatabase($query);
				return $query;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getInstructorDetail($instructorId)
		{
			try{
				$query = "SELECT * FROM tblInstructor WHERE instructor_id = '$instructorId'";
				$result = DBConnection::readFromDatabase($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getInstructorsOfThisAcademicUnit($academicUnitId)
		{
			try{
				$query = "SELECT * FROM tblInstructor WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name, last_name ASC";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}	
		
		public static function searchInstructorByIdNumber($idNumber){
			try{
				$query = "SELECT * FROM tblInstructor WHERE instructor_id LIKE '%$idNumber%'";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function searchInstructorByName($firstName,$lastName){
			try{
				$query = "SELECT * FROM tblInstructor WHERE first_name LIKE '$firstName%' AND last_name LIKE '$lastName%'";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}			
		}
		
	}//end class
?>