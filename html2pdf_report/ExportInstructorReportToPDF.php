<?php
	include_once('html2fpdf.php');
	$pdf = new HTML2FPDF();
	$pdf->AddPage();
	$fp = fopen("../ManageInstructorReport.php","r");
	$strContent = fread($fp,filesize("../ManageInstructorReport.php"));
	fclose($fp);
	$pdf->WriteHTML($strContent);
	$pdf->Output("ManageInstructorReport.pdf");
?>