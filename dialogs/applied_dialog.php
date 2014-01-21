<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script language="JavaScript" src="../calendar/ui_datepicker.js"></script>
<script>

$("#log_application_button").click(function(){
	$("#interview_box_status").html("Scheduling Interview ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
	$("#create_loader").show()
	$.post("ajax/applied_log_ajax.php?lead_id=<? echo $_GET['lead_id']; ?>",
			{
			previous_interview: $("#previous_interview").val(),
			application_details: $("#interview_comments").val(),
			},
			function(result){
			$("#interview_box_status").html("");
      		$("#interview_box").html(result);
   			});

});

</script>

<div id='cover' ></div>

<div id='interview_box'>

<div id="interview_box_status" style="margin-bottom:10px; color:#900;"></div>

Log Application<br><br>

Enter any additional details<br>

<textarea cols='25' id='interview_comments' rows='2'></textarea><br><br>

<input type="checkbox" id="previous_interview" name="previous_interview" />Previous Interview?<br /><br />

<input type='button' name='Button' id='log_application_button' value='Log Application' style='font-size:12px;'  /><br><br>

<a href='' id='continue_edit' >Click Here to Cancel</a></div>

