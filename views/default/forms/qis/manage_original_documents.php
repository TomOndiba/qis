<?php
// once elgg_view stops throwing all sorts of junk into $vars, we can use 
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('group_guid', $vars);
$qis_groups = elgg_extract('qis_groups', $vars, null);
$option_groups[''] = '';
foreach ($qis_groups as $qis_group) {
	$option_groups[$qis_group->guid] = $qis_group->name;
}


?>
<div class='qis-document-form'>
        <label><?php echo elgg_echo("Client"); ?>: </label>
        <?php echo elgg_view("input/dropdown", array( 'name' => 'container_guid', 'value' => $container_guid, 'options_values' => $option_groups, 'id' => 'qis-client-dropdown')); ?>
</div>
<div class='qis-employee-form'>
	<label><?php echo elgg_echo("Employee"); ?>: </label>
	<?php echo elgg_view("input/employee_dropdown", array( 'name' => 'container_guid', 'value' => $container_guid, 'id' => 'qis-employee-dropdown')); ?>
</div>

<div class='qis-company-form'>
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('Register Receipt of Client Organization Original Documents'))); ?>
</div>
<div class='qis-employee-document-form'>
	<?php echo elgg_view('input/submit', array('value' => elgg_echo('Register Receipt of Employee Original Documents'))); ?>
</div>
<script type="text/javascript">
        $(document).ready(function() {
                var client = $("#qis-client-dropdown").val();
                var employee = $("#qis-employee-dropdown").val();
		if (! client) {
			$(".qis-company-form").hide();
		}
		if (! employee) {
			$(".qis-employee-document-form").hide();
		}
                $("#qis-client-dropdown").change(function() {
                	var client = $("#qis-client-dropdown").val();
			if (client) {
				$(".qis-company-form").show();
			} else {
				$(".qis-company-form").hide();
			}
                });
                $("#qis-employee-dropdown").change(function() {
                	var employee = $("#qis-employee-dropdown").val();
			if (employee) {
				$(".qis-employee-document-form").show();
			} else {
				$(".qis-employee-document-form").hide();
			}
                });
        });
</script>
