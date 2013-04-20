<?php
// once elgg_view stops throwing all sorts of junk into $vars, we can use 
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('group_guid', $vars);
$employee_guid = get_input('employee_guid');
if ($employee_guid) {
	$document_type = 'user_document';
} else {
	$document_type = 'company_document';
}
$qis_groups = elgg_extract('qis_groups', $vars, null);
foreach ($qis_groups as $qis_group) {
	$option_groups[$qis_group->guid] = $qis_group->name;
}

?>
<div class='qis-document-form'>
	<label><?php echo elgg_echo("Client"); ?>: </label>
	<?php echo elgg_view("input/dropdown", array( 'name' => 'container_guid', 'disabled', 'value' => $container_guid, 'options_values' => $option_groups, 'id' => 'qis-client-dropdown')); ?>
</div>
<?php
if ($employee_guid) {
?>
	<div id='qis-request-dropdown'>
		<label><?php echo elgg_echo("employee"); ?>: </label>
		<?php echo get_entity($employee_guid)->name; ?>
		<?php echo elgg_view('input/hidden', array('name' => 'user_guid', 'value' => $employee_guid)); ?>
	</div>
<?php
}
?>

<div id='document-form'>
        <label><?php echo $file_label; ?></label>
        <?php echo elgg_view('input/file', array('name' => 'upload', 'id' => 'document-name')); ?>
</div>

<?php
if ($fich_guid) {
	$file_label = elgg_echo("file:replace");
	$submit_label = elgg_echo('save');
	$file = get_entity($fich_guid);

} else {
	$file_label = elgg_echo("file:file");
	$submit_label = elgg_echo('upload');
}

?>
<div class="elgg-foot">
<?php

echo elgg_view('input/hidden', array('name' => 'access_id', 'value' => $access_id));

if ($fich_guid) {
	echo elgg_view('input/hidden', array('name' => 'file_guid', 'value' => $fich_guid));
	$delete_label = elgg_echo('delete');
	echo '<div id="document-delete">';
	echo elgg_view('input/submit', array('name' => 'submit', 'value' => $delete_label));
	echo '</div>';
}

echo '<div id="document-upload">';
echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
echo elgg_view('input/submit', array('name' => 'submit', 'value' => $submit_label));
echo '</div>';

?>
</div>
