<script>
$('#date_time_picker_start').datepicker({
	ampm:true,
	numberOfMonths:2
});

$('#date_time_picker_fa').datepicker({
	ampm:true,
	numberOfMonths:2
});

</script>

<?
include ('../global_includes/connect.php');
include ('../global_includes/functions.php');

$school_id = $_GET['school'];
if ($school_id) { echo $school_id; }else{ echo 'none'; }

?>


<script>
$("#add_button").click(function(){
	  $("#save_yes_box_status").html("Saving to Yes List ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
    	$.post("ajax/add_yes_list_info_ajax.php?lead_id=<? echo $_GET['lead_id']; ?>", $("#yes_list_form").serialize(),
			function(result){
				$("#yes_list_form").hide()
				$("#create_loader").hide()
      			$("#save_yes_box_status").html(result);
   			});
  	});





</script>
<div id='cover' ></div>



<div id='yes_list_box'>


<h2>Yes List</h2>

<div id="save_yes_box_status" style="margin-bottom:10px; color:#900;"> </div>
<form id="yes_list_form">
<div id="yes_list" style="border:thin #666; width:700px; text-align:center;">
<table width="700px">
<tr><td>

<div id="general_info" style="text-align:center; margin-top:-10px; width:700px;">
<table width="700px" style="text-align:left;" >
<tr><td colspan="6"><h3>General Info</h3></td></tr>
<tr>
<td style="text-align: right">Status:</td><td style="text-align: left"><select name="status" id="status"><option value="no">No</option><option value="maybe">Maybe</option><option value="yes">Yes</option></select></td>
<td style="text-align: right">Program:</td>
<td>
<select id="program" name="program">
<?


$result = mysql_query("SELECT * FROM programs WHERE schoolid=$school_id AND active=1");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	echo "<option value='".$row["ProgramId"]."'>".$row["ProgramName"]."</option>";
  }

?>

</select>
</td>
<td style="text-align: right">Schedule Date</td><td><input type='text' name='date_time_picker_start' id='date_time_picker_start' /></td>
</tr>
</table>
</div>

<div id="supply_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="6"><h3>Welcome Letters</h3></td></tr>
<tr>
<td style="text-align: right">Orientation Letter</td><td style="text-align: left"><input type="checkbox" id="orient_letter" name="orient_letter" /></td>

<td style="text-align: right">Program Director</td><td style="text-align: left"><input type="checkbox" id="prog_dir_letter" name="prog_dir_letter" /></td>
<td style="text-align: right">Placement</td><td style="text-align: left"><input type="checkbox" id="placement_letter" name="placement_letter" /></td>
</tr>
<tr>
<td style="text-align: right">Director of Ed.</td><td style="text-align: left"><input type="checkbox" id="dir_ed_letter" name="dir_ed_letter" /></td>
<td style="text-align: right">Executive Director</td><td style="text-align: left"><input type="checkbox" id="exec_dir_letter" name="exec_dir_letter" /></td><td style="text-align: right"></td><td style="text-align: left"></td>
</tr>
</table>
</div>

<div id="transfer_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="6"><h3>Transfer Info</h3></td></tr>
<tr>
<td>Trans In:</td><td><input type="radio" name="trans_in_out" value="in"/></td><td>Trans Out:</td><td><input type="radio" name="trans_in_out" value="out"/></td><td>Class</td><td><input type="text" id="trans_class" name="trans_class" /></td>
</tr>
</table>
</div>

<div id="financial_aid_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="3"><h3>Financial Aid</h3></td></tr>
<tr>
<td width="168">FA Date:</td><td width="163"><input type='text' name='date_time_picker_fa' id='date_time_picker_fa' /></td><td width="335" >Comments</td>
</tr>
<tr>
<td>FA Status:</td>
<td>
<select id="fa_status" name="fa_status">
<?
$result = mysql_query("SELECT * FROM fa_status");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	echo "<option value='".$row["fa_status"]."'>".$row["fa_status"]."</option>";
  }
?>
</select>
</td><td rowspan="2"><textarea id="fa_comments" name="fa_comments" cols="50"></textarea></td>
</tr>
<tr>
<td>FA Rep</td>
<td>
<select id="fa_rep" name="fa_rep">
<?
$result = mysql_query("SELECT * FROM school WHERE schoolid = $school_id");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	$school_name = $row['school'];
  }

$result = mysql_query("SELECT * FROM users WHERE role_id = 3 AND $school_name=1");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	echo "<option value='".$row["user_id"]."'>".$row["firstname"]." ".$row["lastname"]."</option>";
  }
?>
</select>
</td>
</tr>
</table>
</div>

<div id="enrollment components" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="8"><h3>Enrollment Components</h3></td></tr>
<tr>
<td width="114" style="text-align: right">100 Paid:</td><td width="74" style="text-align: left"><input type="checkbox" id="100_paid" name="100_paid" /></td><td width="98" style="text-align: right" >Enrollment</td><td width="65" style="text-align: left"><input type="checkbox" id="enrollment" name="enrollment" /></td><td width="128" style="text-align: right">Transcript</td><td width="59" style="text-align: left"><input type="checkbox" id="transcript" name="transcript" /></td><td width="106" style="text-align: right" >Physical</td><td width="20" style="text-align: left"><input type="checkbox" id="physical" name="physical" /></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Immunization</td><td style="text-align: left"><input type="checkbox" id="immunization" name="immunization" /></td><td style="text-align: right" >Drug Test</td><td style="text-align: left"><input type="checkbox" id="drug_test" name="drug_test" /></td><td style="text-align: right">Criminal Rec.</td><td style="text-align: left"><input type="checkbox" id="crim_rec" name="crim_rec" /></td><td style="text-align: right" >Child Abuse</td><td style="text-align: left"><input type="checkbox" id="child_abuse" name="child_abuse" /></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Buck Am</td><td style="text-align: left"><input type="checkbox" id="buck_am" name="buck_am" /></td><td style="text-align: right" >Cat Sheet</td><td style="text-align: left"><input type="checkbox" id="cat_sheet" name="cat_sheet" /></td><td style="text-align: right">Acceptance</td><td style="text-align: left"><input type="checkbox" id="acceptance" name="acceptance" /></td><td style="text-align: right" ></td><td style="text-align: left"></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right"></td><td style="text-align: left"></td><td style="text-align: right" >Test</td><td><input type="text" name="test" id="test" /></td><td style="text-align: right">Agency</td><td>value</td><td ></td><td></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Comments</td><td colspan="7"><textarea id="gen_comments" name="gen_comments" cols="75"></textarea></td>
</tr>
</table>
</div>

<input type='button' name='Button' id='add_button' value='Add to Yes List' style='font-size:12px;'  /><br><br>

<a href='' id='continue_edit' >Click Here to Cancel</a>

</td>
</tr>
</table>
</form>
</div>

