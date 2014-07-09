<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrator
 *
 * @author Mahder
 */
include_once("DBConnection.php");

class Administrator {
	 private $instructorId;    
    private $firstName;
    private $lastName;
    private $email;       
    private $userName;
    private $password;    

    public function Administrator($firstName,$lastName,$email,$userName,$password)
    {    	      	  
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);               
        $this->setUserName($userName);
        $this->setPassword($password);
    }
    
    public function setInstructorId($instructorId)
    {
    	$this->instructorId = $instructorId;
    }
    
    public function setEmail($email)
    {
    	$this->email = $email;
    }
    
    public function setMobilePhone($mobilePhone)
    {
    	$this->mobilePhone = $mobilePhone;
    }
    
    public function setAdministrativePosition($administrativePosition)
    {
    	$this->administrativePosition = $administrativePosition;
    }
    
    public function setAcademicUnitId($academicUnitId)
    {
    	$this->academicUnitId = $academicUnitId;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function setPassword($password)
    {
        $this->password = MD5($password);
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getPassword()
    {
        return $this->password;
    }
    
    public function getInstructorId()
    {
    	return $this->instructorId;
    }
    
    public function getEmail()
    {
    	return $this->email;
    }
    
    public function getAcademicUnitId()
    {
    	return $this->academicUnitId;
    }
    
    public function getAdministrativePosition()
    {
    	return $this->administrativePosition;
    }
    
    public function getMobilePhone()
    {
    	return $this->mobilePhone;
    }

    public function addAdministrator()
    {
        try{
            $query = "INSERT INTO tblAdmin VALUES (0,'$this->firstName','$this->lastName','$this->email','$this->userName','$this->password')";
            //print($query);
            DBConnection::executeQuery($query);
        }
        catch(Exception $e){
            $e->__toString();
        }
    }
    
    public static function updateAdministrator($id,$firstName,$lastName,$email){
    	try{
    		$query = "UPDATE tblAdmin SET firstName='$firstName', lastName='$lastName', email='$email' WHERE id = $id";
    		//print($query);
    		DBConnection::executeQuery($query);
    	}catch(Exception $e){
    		$e->__toString();
    	}
    }
    
    public static function getAdministrator($id){
    	try{
    		$query = "SELECT * FROM tblAdmin WHERE id = $id";
    		$result = DBConnection::executeQuery($query);
    		$resultRow = mysql_fetch_object($result);
    		return $resultRow;
		}catch(Exception $e){
			$e->__toString();
		}    	
    }
    
    public static function deleteAdministrator($id){
    	try{
    		$query = "DELETE FROM tblAdmin WHERE id = $id";
    		DBConnection::executeQuery($query);
    	}catch(Exception $e){
    		$e->__toString();
    	}
    }
}//end class
?>
