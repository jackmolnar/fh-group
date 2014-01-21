
<script>



$("#contacted_button").click(function(){
	$("#contact_attempt_box_status").html("Logging Attempt ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
	$("#create_loader").show()
	$.post("ajax/contacted_ajax.php?lead_id=<? echo $_GET['lead_id']; ?>",
			{
			reminder_date: $("#date_time_picker").val(),
			contacted_details: $("#contacted_comments").val(),
			contacted_reminder_details: $("#contacted_reminder_comments").val()
			},
			function(result){
					$("#contact_attempt_box_status").html("");
      			$("#contact_attempt_box").html(result);
   			});

});

$('#date_time_picker').datetimepicker({
	ampm:true,
	stepMinute: 15,
	numberOfMonths:2,
	hourMin: 8,
	hourMax: 19,
	hour:13
});

</script>

<div id='cover' ></div>



<div id='contact_attempt_box'>
<div id="contact_attempt_box_status" style="margin-bottom:10px; color:#900;"> </div>

Contacted<br><br>Enter Details Of Attempt<br>

<textarea cols='25' id='contacted_comments' rows='2'></textarea><br><br>

Set Reminder Date For Next Attempt<br> 

<input type='text' name='date_time_picker' id='date_time_picker' /><br><br>

Set Reminder Details For Next Attempt<br>

<textarea cols='25' id='contacted_reminder_comments' rows='2'></textarea><br><br>

<input type='button' name='Button' id='contacted_button' value='Log Contact' style='font-size:12px;'  /><br><br>

<a href='' id='continue_edit' >Click Here to Cancel</a></div>
