
<?

include ('../global_includes/connect.php');
include ('../global_includes/functions.php');

$school_id = $_REQUEST['school_assigned']; 

$lead_id = $_REQUEST['lead_id'];

$result = mysql_query("SELECT * FROM school WHERE schoolid=$school_id");

while($row = mysql_fetch_array($result))
  {
	  $school_name = $row['full_name'];
  }



?>

<script>

$("#assign_school_button").click(function(){
	$("#assign_rep_box").html("Assigning School ... <img  id='create_loader' src='images/ajax-loader.gif' width='16' height='16'  />");
	$("#create_loader").show()
	$.post("./ajax/assign_school_ajax.php?lead_id=<? echo $lead_id; ?>&school_id=<? echo $school_id; ?>", 
			{
			},
			function(result){
				$("#create_loader").hide()
      			$("#assign_rep_box").html(result);
   			});
});

</script>

<div id='cover' ></div><div id='assign_rep_box'>Assign School<br><br>Assign this lead to <? echo $school_name; ?>?<br><br><input type='button' name='Button' id='assign_school_button' value='Assign to School' style='font-size:12px;'  /><br><br><a href='' id='continue_edit' >Click Here to Cancel</a></div>
