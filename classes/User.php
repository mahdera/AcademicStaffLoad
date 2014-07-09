<?php
	include_once("DBConnection.php");
	class User{
		private $instructorId;
		private $firstName;
		private $lastName;
		private $email;
		private $mobilePhone;
		private $academicUnitId;
		private $administrativePosition;
		private $username;
		private $password;
		
		public function User($instructorId,$firstName,$lastName,$email,$mobilePhone,$academicUnitId,$administrativePosition,$username,$password)
		{
			$this->setInstructorId($instructorId);
			$this->setFirstName($firstName);
			$this->setLastName($lastName);
			$this->setEmail($email);
			$this->setMobilePhone($mobilePhone);
			$this->setAcademicUnitId($academicUnitId);
			$this->setAdministrativePosition($administrativePosition);
			$this->setUsername($username);
			$this->setPassword($password);
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
		
		public function setAcademicUnitId($academicUnitId)
		{
			$this->academicUnitId = $academicUnitId;
		}
		
		public function setAdministrativePosition($administrativePosition)
		{
			$this->administrativePosition = $administrativePosition;
		}
		
		public function setUsername($username)
		{
			$this->username = $username;
		}
		
		public function setPassword($password)
		{
			$this->password = MD5($password);
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
		
		public function getAcademicUnitId()
		{
			return $this->academicUnitId;
		}
		
		public function getAdministrativePosition()
		{
			return $this->administrativePosition;
		}
		
		public function getUsername()
		{
			return $this->username;
		}
		
		public function getPassword()
		{
			return $this->password;
		}
		
		public function addUser()
		{
			try{
				$query = "INSERT INTO tblUser VALUES ('$this->instructorId','$this->firstName','$this->lastName','$this->email','$this->mobilePhone','$this->academicUnitId','$this->administrativePosition','$this->username','$this->password')";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteUser($instructorId)
		{
			try{
				$query = "DELETE FROM tblUser WHERE instructor_id = '$instructorId'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateUser($instructorId,$firstName,$lastName,$email,$mobilePhone,$academicUnitId,$administrativePosition)
		{
			try{
				$query = "UPDATE tblUser SET first_name='$firstName', last_name='$lastName', mobile_phone='$mobilePhone', academic_unit_id = '$academicUnitId', administrative_position = '$administrativePosition' WHERE instructor_id = '$instructorId'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updateUsername($email,$currentusername,$newusername)
		{
			try{
				$query = "UPDATE tblUser SET username = '$newusername' WHERE email = '$email' AND username = '$currentusername'";				
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function updatePassword($email,$username,$currentPassword,$newPassword)
		{
			try{				
				$query = "UPDATE tblUser SET pass_word = MD5('$newPassword') WHERE email = '$email' AND username = '$username' AND pass_word = MD5('$currentPassword')";				
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllUsersInThisAcademicUnit($academicUnitId){
			try{
				$query = "SELECT * FROM tblUser WHERE academic_unit_id = '$academicUnitId' ORDER BY first_name,last_name";
				$result = DBConnection::executeQuery($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getUser($instId){
			try{
				$query = "SELECT * FROM tblUser WHERE instructor_id = '$instId'";
				$result = DBConnection::executeQuery($query);
				$resultRow = mysql_fetch_object($result);
				return $resultRow;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function resetThisAccount($instId,$username,$password){
			try{
				$query = "UPDATE tblUser SET pass_word = MD5('$password') WHERE instructor_id = '$instId' AND username = '$username'";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}			
		}
		
	}//end class
?>