<?php
	include_once("DBConnection.php");
	class CourseCategory{
		private $id;
		private $courseCategoryName;
		
		public function CourseCategory($courseCategoryName)
		{
			$this->setCourseCategoryName($courseCategoryName);
		}
		
		public function setCourseCategoryName($courseCategoryName)
		{
			$this->courseCategoryName = $courseCategoryName;
		}
		
		public function getCourseCategoryName()
		{
			return $this->courseCategoryName;
		}
		
		public function addCourseCategory()
		{
			try{
				$query = "INSERT INTO tblCourseCategory VALUES(0,'$this->courseCategoryName')";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}			
		}
		
		public static function updateCourseCategory($id,$courseCategoryName)
		{
			try{
				$query = "UPDATE tblCourseCategory SET course_category_name = '$courseCategoryName' WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteCourseCategory($id)
		{
			try{
				$query = "DELETE FROM tblCourseCategory WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getAllCourseCategory()
		{
                    try{
                        $query = "SELECT * FROM tblCourseCategory";
                        $result = DBConnection::readFromDatabase($query);
                        return $result;
                    }catch(Exception $e){
                       $e->__toString();
                    }
		}
	}//end class
?>