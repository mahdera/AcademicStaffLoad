<?php
	include_once("DBConnection.php");
	class AcademicRank{
		private $id;
		private $rankName;		
		
		public function AcademicRank($rankName)
		{
			$this->setRankName($rankName);
		}
		
		public function setRankName($rankName)
		{
			$this->rankName = $rankName;
		}
		
		public function getRankName()
		{
			return $this->rankName;
		}
		
		public function addAcademicRank()
		{
			try{
				$query = "INSERT INTO tblAcademicRank VALUES(0,'$this->rankName')";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}			
		}
		
		public static function updateAcademicRank($id,$rankName)
		{
			try{
				$query = "UPDATE tblAcademicRank SET rank_name = '$rankName' WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function deleteAcademicRank($id)
		{
			try{
				$query = "DELETE FROM tblAcademicRank WHERE id = $id";
				DBConnection::executeQuery($query);
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
		public static function getRankNameFor($id)
		{
			try{
				$query = "SELECT * FROM tblAcademicRank WHERE id = $id";				
				$result = DBConnection::executeQuery($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}	
		
		public static function getAllAcademicRanks()
		{
			try{
				$query = "SELECT * FROM tblAcademicRank";
				$result = DBConnection::readFromDatabase($query);
				return $result;
			}catch(Exception $e){
				$e->__toString();
			}
		}
		
	}//end class
?>