<HTML>
<HEAD>
	<title>Export table to Excel in 10 lines</title>
	<script Language="javascript">
	function TableToExcel()
	{
		var strCopy = document.getElementById("MyTable").innerHTML;
		window.clipboardData.setData("Text", strCopy);
		var objExcel = new ActiveXObject ("Excel.Application");
		objExcel.visible = true;
		
		var objWorkbook = objExcel.Workbooks.Add;
		var objWorksheet = objWorkbook.Worksheets(1);
		objWorksheet.Paste;
	}
</script>
</HEAD>
<BODY>
	<a href="javascript:RunScript()">Export to Excel</a><br/>
	<span id="MyTable">
		<table>
			<tr>
				<td style="background-color:Gray;">10 lines</td>
			</tr>
			<tr>
				<td>This table was exported to Excel</td>
			</tr>
		</table>
	</span>
</BODY>
</HTML>