
<?

include ('../global_includes/connect.php');
include ('../global_includes/functions.php');

$lead_id = $_REQUEST['lead_id'];


?>

<script>

$("#delete_confirm_button").click(function(){
	$("#assign_rep_box").html("Deleting Lead ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
	$("#create_loader").show()
	$.post("./ajax/delete_lead_ajax.php?lead_id=<? echo $lead_id; ?>", 
			{
			},
			function(result){
				$("#create_loader").hide()
      			$("#assign_rep_box").html(result);
   			});
});

</script>

<div id='cover' ></div><div id='assign_rep_box'>Delete Lead<br><br>Are you sure you want to delete this lead?<br><br><input type='button' name='Button' id='delete_confirm_button' value='Delete Lead' style='font-size:12px;'  /><br><br><a href='' id='continue_edit' >Click Here to Cancel</a></div>
