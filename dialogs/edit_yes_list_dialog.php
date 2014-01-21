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
$lead_id = $_GET['lead_id'];
if ($school_id) { echo $school_id; }else{ echo 'none'; }


$result = mysql_query("SELECT * FROM yes_list WHERE LeadsId=$lead_id");

while($row = mysql_fetch_array($result))
  {
	  $y_id = $row['YId'];
	  $lead_id = $row['LeadsId'];
	  $y_class = $row['YClass'];
	  $y_yes = $row['YYes'];
	  $y_maybe = $row['YMaybe'];
	  $y_no = $row['YNo'];
	  if ($row['YTransIn']=='Y') {$trans_in= 'checked';}else{$trans_in= '';}
	  if ($row['YTransOut']=='Y') {$trans_out= 'checked';}else{$trans_out= '';}
	  $program2 = $row['YProgram'];
	  $fa_date = date("m/d/Y", $row['YFADate']);
	  $fa_status = $row['YFAStatus'];
	  $fa_rep = $row['YFARep'];
	  if ($row['Y100Paid']=='on') {$hun_paid= 'checked';}else{$hun_paid= '';}
	  if ($row['YHSTransGEI']=='on') {$transcript= 'checked';}else{$transcript= '';}
	  if ($row['YPhys']=='on') {$physical= 'checked';}else{$physical= '';}
	  if ($row['YImmune']=='on') {$immunization= 'checked';}else{$immunization= '';}
	  if ($row['YBuckAm']=='on') {$buck_am= 'checked';}else{$buck_am= '';}
	  if ($row['YCatSheet']=='on') {$cat_sheet= 'checked';}else{$cat_sheet= '';}
	  if ($row['YPants']=='on') {$placement_letter= 'checked';}else{$placement_letter= '';}
	  if ($row['YShirt']=='on') {$prog_dir_letter= 'checked';}else{$prog_dir_letter= '';}
	  if ($row['YCoat']=='on') {$dir_ed_letter= 'checked';}else{$dir_ed_letter= '';}
	  if ($row['YCrimRec']=='on') {$crim_rec= 'checked';}else{$crim_rec= '';}
	  if ($row['YDrugTest']=='on') {$drug_test= 'checked';}else{$drug_test= '';}
	  if ($row['YClearanceNot']=='on') {$exec_dir_letter= 'checked';}else{$exec_dir_letter= '';}
	  if ($row['YTest']=='on') {$test= 'checked';}else{$test= '';}
	  if ($row['YChildAbuse']=='on') {$child_abuse= 'checked';}else{$child_abuse= '';}
	  if ($row['YAcceptance']=='on') {$acceptance= 'checked';}else{$acceptance= '';}
	  if ($row['YComplete']=='on') {$complete= 'checked';}else{$complete= '';}
	  if ($row['YPrereq']=='on') {$orient_letter= 'checked';}else{$orient_letter= '';}
	  $gen_comments = $row['YComments'];
	  if ($row['YEnrollment']=='on') {$enrollment= 'checked';}else{$enrollment= '';}
	  $fa_comments = $row['YFAComments'];  
	  $reason_not_coming = $row['YReasonNotComing'];
	  $key = $row['YKey'];
	  $start_date = date("m/d/Y", $row['ScStDate']);
	  $program2 = $row['Program'];
	  $YShift = $row['shift'];
	  $YTimeStamp = $row['current_timestamp'];
	  $Username = $row['username'];
	  $Yagency = $row['agency'];

  }

switch (1)
{
	case $y_yes : $y_yes = 'selected'; $y_maybe=''; $y_no='';
	break;
	case $y_maybe : $y_yes = ''; $y_maybe='selected'; $y_no='';
	break;
	case $y_no : $y_yes = ''; $y_maybe=''; $y_no='selected';
	break;
}




?>


<script>
$("#edit_button").click(function(){
	  $("#save_yes_box_status").html("Saving to Yes List ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
		$("#create_loader").show()
    	$.post("ajax/edit_yes_list_info_ajax.php?lead_id=<? echo $_GET['lead_id']; ?>&y_id=<? echo $y_id; ?>", $("#yes_list_form").serialize(),
			function(result){
				$("#yes_list_form").hide()
				$("#create_loader").hide()
      			$("#save_yes_box_status").html(result);
   			});
  	});





</script>
<div id='cover' ></div>



<div id='yes_list_box'>
<div id="save_yes_box_status" style="margin-bottom:10px; color:#900;"> </div>

<h2>Yes List</h2>
<form id="yes_list_form">
<div id="yes_list" style="border:thin #666; width:700px; text-align:center;">
<table width="700px">
<tr><td>

<div id="general_info" style="text-align:center; margin-top:-10px; width:700px;">
<table width="700px" style="text-align:left;" >
<tr><td colspan="6"><h3>General Info</h3></td></tr>
<tr>
<td style="text-align: right">Status:</td><td style="text-align: left"><select name="status" id="status"><option value="no" <? echo $y_no; ?>>No</option><option value="maybe" <? echo $y_maybe; ?>>Maybe</option><option value="yes" <? echo $y_yes; ?>>Yes</option></select></td>
<td style="text-align: right">Program:</td>
<td>
<select id="program" name="program">
<?


$result = mysql_query("SELECT * FROM programs WHERE schoolid=$school_id AND active=1");
while($row = mysql_fetch_array($result))
  {
	//POPULATE SELECT LIST
	if ($program2 == $row["ProgramId"]){
	echo "<option value='".$row["ProgramId"]."' selected='selected'>".$row["ProgramName"]."</option>";
	} else {
		echo "<option value='".$row["ProgramId"]."'>".$row["ProgramName"]."</option>";
	}
  }

?>

</select>
</td>
<td style="text-align: right">Schedule Date</td><td><input type='text' name='date_time_picker_start' id='date_time_picker_start' value="<? echo $start_date; ?>" /></td>
</tr>
</table>
</div>

<div id="supply_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="6"><h3>Welcome Letters</h3></td></tr>
<tr>
<td style="text-align: right">Orientation Letter</td><td style="text-align: left"><input type="checkbox" id="orient_letter" name="orient_letter" <? echo $orient_letter;?> /></td>

<td style="text-align: right">Program Director</td><td style="text-align: left"><input type="checkbox" id="prog_dir_letter" name="prog_dir_letter" <? echo $prog_dir_letter; ?> /></td>
<td style="text-align: right">Placement</td><td style="text-align: left"><input type="checkbox" id="placement_letter" name="placement_letter" <? echo $placement_letter; ?> /></td>
</tr>
<tr>
<td style="text-align: right">Director of Ed.</td><td style="text-align: left"><input type="checkbox" id="dir_ed_letter" name="dir_ed_letter" <? echo $dir_ed_letter; ?> /></td>
<td style="text-align: right">Executive Director</td><td style="text-align: left"><input type="checkbox" id="exec_dir_letter" name="exec_dir_letter" <? $exec_dir_letter; ?> /></td><td style="text-align: right"></td><td style="text-align: left"></td>
</tr>
</table>
</div>

<div id="transfer_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="6"><h3>Transfer Info</h3></td></tr>
<tr>
<td>Trans In:</td><td><input type="radio" name="trans_in_out" value="in" <? echo $trans_in; ?>/></td><td>Trans Out:</td><td><input type="radio" name="trans_in_out" value="out" <? echo $trans_out; ?>/></td><td>Class</td><td><input type="text" id="trans_class" name="trans_class" /></td>
</tr>
</table>
</div>

<div id="financial_aid_info" style="width:700px;">
<table width="700px" style="text-align:center;">
<tr><td colspan="3"><h3>Financial Aid</h3></td></tr>
<tr>
<td width="168">FA Date:</td><td width="163"><input type='text' name='date_time_picker_fa' id='date_time_picker_fa' value="<? echo $fa_date; ?>" /></td><td width="335" >Comments</td>
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
	if ($fa_status == $row["fa_status_id"]) {
		echo "<option value='".$row["fa_status_id"]."' selected='selected'>".$row["fa_status"]."</option>";
	} else {
		echo "<option value='".$row["fa_status_id"]."' >".$row["fa_status"]."</option>";
	}
  }
?>
</select>
</td><td rowspan="2"><textarea id="fa_comments" name="fa_comments" cols="50"><? echo $fa_comments; ?></textarea></td>
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
	if ($fa_rep == $row['user_id']){
	echo "<option value='".$row["user_id"]."' selected='selected'>".$row["firstname"]." ".$row["lastname"]."</option>";
	} else {
		echo "<option value='".$row["user_id"]."' >".$row["firstname"]." ".$row["lastname"]."</option>";
	}
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
<td width="114" style="text-align: right">100 Paid:</td><td width="74" style="text-align: left"><input type="checkbox" id="100_paid" name="100_paid" <? echo $hun_paid; ?>  /></td><td width="98" style="text-align: right" >Enrollment</td><td width="65" style="text-align: left"><input type="checkbox" id="enrollment" name="enrollment" <? echo $enrollment; ?> /></td><td width="128" style="text-align: right">Transcript</td><td width="59" style="text-align: left"><input type="checkbox" id="transcript" name="transcript" <? echo $transcript; ?> /></td><td width="106" style="text-align: right" >Physical</td><td width="20" style="text-align: left"><input type="checkbox" id="physical" name="physical" <? echo $physical; ?> /></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Immunization</td><td style="text-align: left"><input type="checkbox" id="immunization" name="immunization" <? echo $immunization; ?> /></td><td style="text-align: right" >Drug Test</td><td style="text-align: left"><input type="checkbox" id="drug_test" name="drug_test" <? echo $drug_test; ?> /></td><td style="text-align: right">Criminal Rec.</td><td style="text-align: left"><input type="checkbox" id="crim_rec" name="crim_rec" <? echo $crim_rec; ?> /></td><td style="text-align: right" >Child Abuse</td><td style="text-align: left"><input type="checkbox" id="child_abuse" name="child_abuse" <? echo $child_abuse ?> /></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Buck Am</td><td style="text-align: left"><input type="checkbox" id="buck_am" name="buck_am" <? echo $buck_am; ?> /></td><td style="text-align: right" >Cat Sheet</td><td style="text-align: left"><input type="checkbox" id="cat_sheet" name="cat_sheet" <? echo $cat_sheet; ?> /></td><td style="text-align: right">Acceptance</td><td style="text-align: left"><input type="checkbox" id="acceptance" name="acceptance" <? echo $acceptance ?> /></td><td style="text-align: right" ></td><td style="text-align: left"></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right"></td><td style="text-align: left"></td><td style="text-align: right" >Test</td><td><input type="text" name="test" id="test" <? echo $test; ?> /></td><td style="text-align: right">Agency</td><td>value</td><td ></td><td></td>
</tr>
<tr>

</tr>
<tr>
<td style="text-align: right">Comments</td><td colspan="7"><textarea id="gen_comments" name="gen_comments" cols="75"><? echo $gen_comments; ?></textarea></td>
</tr>
</table>
</div>

<input type='button' name='Button' id='edit_button' value='Update Yes List Info' style='font-size:12px;'  /><br><br>

<a href='' id='continue_edit' >Click Here to Cancel</a>

</td>
</tr>
</table>
</form>
</div>

