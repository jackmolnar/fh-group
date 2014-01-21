<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script language="JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script language="JavaScript" src="../calendar/ui_datepicker.js"></script>
<script>

$("#schedule_interview_button").click(function(){
	$("#interview_box_status").html("Scheduling Interview ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
	$("#create_loader").show()
	$.post("ajax/schedule_interview_ajax.php?lead_id=<? echo $_GET['lead_id']; ?>",
			{
			date_time_schedule: $("#date_time_picker").val(),
			interview_details: $("#interview_comments").val(),
			set_interview_reminder: $("#set_interview_reminder:checked").val()
			},
			function(result){
			$("#interview_box_status").html("");
      		$("#interview_box").html(result);
   			});

});

	

</script>


<script>
	$(function() {
$('#date_time_picker').datetimepicker({
	ampm:true,
	stepMinute: 15,
	numberOfMonths:2,
	hourMin: 8,
	hourMax: 19,
	hour:13
});
});
	</script>
    

<div id='cover' ></div>

<div id='interview_box'>

<div id="interview_box_status" style="margin-bottom:10px; color:#900;"></div>

Schedule Interview<br><br>

Enter Date and Time

<input type='text' name='date_time_picker' id='date_time_picker' /> <br><br>

Enter any additional details<br>

<textarea cols='25' id='interview_comments' rows='2'></textarea><br><br>Set Reminder? <input type='checkbox' id='set_interview_reminder' /><br><br>

<input type='button' name='Button' id='schedule_interview_button' value='Schedule Interview' style='font-size:12px;'  /><br><br>

<a href='' id='continue_edit' >Click Here to Cancel</a></div>

