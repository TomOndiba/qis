<?php 
$group_guid = elgg_extract("group_guid", $vars);
$employee_guid = elgg_extract("employee_guid", $vars);
$site_url = elgg_get_site_url();
?>
<select id="employee-guid" class="elgg-input" name="employee_guid"/>
</select>
<div class="clearfloat"></div>
<script type="text/javascript">
	$(document).ready(function() {
       		var $dropdown = $("#qis-client-dropdown");
       		var group_guid = $dropdown.children("option").filter(":selected").val();
		var passedEmployeeGuid = '<?php echo $employee_guid; ?>';
		$.getJSON( "<?php echo $site_url; ?>get_employees", {"group_guid": group_guid},function(data){
       			//alert($dropdown.children("option").filter(":selected").val());
       			//alert(data.toSource());
			var $employeeGUID = $("#employee-guid");
              		$employeeGUID.empty();
              		$.each(data, function() {
				//alert(passedRequestGuid+' '+this.request_guid);
				if ( passedEmployeeGuid && this.employee_guid == passedEmployeeGuid) {
                      			$employeeGUID.append("<option value=" + this.employee_guid +" selected>" + this.employee_name + "</option>");
				} else {
                      			$employeeGUID.append("<option value=" + this.employee_guid +">" + this.employee_name + "</option>");
				}
       			});
		});
		$("#qis-client-dropdown").change(function() {
       			var $dropdown = $(this);
       			//alert($dropdown.prop('outerHTML'));
       			var group_guid = $dropdown.children("option").filter(":selected").val();
			//alert(group_guid);
			$.getJSON( "<?php echo $site_url; ?>get_employees", {"group_guid": group_guid},function(data){
       				//alert($dropdown.children("option").filter(":selected").val());
       				//alert(data.toSource());
				var $employeeGUID = $("#employee-guid");
              			$employeeGUID.empty();
              			$.each(data, function() {
					//alert(passedRequestGuid+' '+this.request_guid);
					if ( passedEmployeeGuid && this.employee_guid == passedEmployeeGuid) {
                      				$employeeGUID.append("<option value=" + this.employee_guid +" selected>" + this.employee_name + "</option>");
					} else {
                      				$employeeGUID.append("<option value=" + this.employee_guid +">" + this.employee_name + "</option>");
					}
       				});
			});
		});
	});
</script>
