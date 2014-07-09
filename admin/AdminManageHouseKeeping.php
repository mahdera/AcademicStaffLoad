<?php
	include_once('../classes/InstructorLoadRepository.php');
	include_once('../classes/LoadSummaryRepository.php');
	include_once('../classes/InstructorLoad.php');
	include_once('../classes/SemesterLoadSummery.php');	
	//now do the copying here
	//first start with the insturctor load repository table...and then do the same for load summary repository
	
	InstructorLoadRepository::importDataFromInstructorLoad();
	LoadSummaryRepository::importDataFromSemesterLoadSummary();
	//the next remove all the data from the InstructorLoad and SemesterLoadSummery tables
	InstructorLoad::truncateInstructorLoad();
	SemesterLoadSummery::truncateSemesterLoadSummary();
	header("Location: HouseKeepingProcessInformation.php");
?>