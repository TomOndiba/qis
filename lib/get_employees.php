<?php 
global $CONFIG;

$q = sanitize_string(get_input("q"));
$result = array();

$group_guid = sanitize_string(get_input("group_guid"));
$group = get_entity($group_guid);
$submitter = elgg_get_logged_in_user_entity();

if((! $submitter->isAdmin()) && (! $group->isMember($submitter) || ! check_entity_relationship($submitter->getGUID(), "group_admin", $group_guid))){
        register_error(elgg_echo('pas le droit'));
        exit();
}
$employees = get_group_members($group_guid,0);

$result[] = array('employee_guid'=>'','employee_name' => '');
foreach($employees as $employee){
	if (! $employee->isAdmin()) {
		$result[] = array('employee_guid'=>$employee->getGUID(),'employee_name' => $employee->name);
	}
}
$json = array('success' => TRUE, 'item' => $result);

//header("Content-Type: application/json");
echo json_encode(array_values($result));
//echo json_encode($json);

exit();
