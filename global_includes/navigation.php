
<script type="text/javascript">
$(document).ready(function(){
//
//
//
 
$("#nav_buttons li").mouseover(function(){
     $(this).css("background-image", "url(images/title_bar_middle_roll.jpg)");
  	});
$("#nav_buttons li").mouseout(function(){
     $(this).css("background-image", "url(images/title_bar_middle.jpg)");
  	});

//
//
});

</script>




<ul id="nav_buttons">
<li id="dashboard_button"><a href="dashboard.php">DASHBOARD</a></li>
<li id="create_new_lead_button"><a href="lead_detail.php?lead_id=&type=create">NEW LEAD</a></li>
<li id="find_leads_button"><a href="search_leads.php">SEARCH LEADS</a></li>
<li id="view_yes_list_button"><a href="yes_list.php">YES LIST</a></li>
<li id="reports_button"><a href="reports.php">REPORTS</a></li>
<li id="admin_button"><a href="admin.php">ADMIN</a></li>
</ul>