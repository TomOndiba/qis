<?php

if (elgg_is_logged_in()) {
	//$submitter = elgg_get_logged_in_user_entity();
	//if ($submitter->qisusertype != 'Immigration Agency Portal Coordinator') {
	       	//register_error(elgg_echo("Not allowed"));
	       	//forward('/qis');
	//}
        $group_guid = get_input('container_guid');
        //$group_guid = extract('container_guid',$vars);
        $employee_guid = get_input('employee_guid');
        //$employee_guid = extract('employee_guid',$vars);
        if ($group_guid) {
        	$group = get_entity($group_guid);
        	$access_id = $group->group_acl;
        } else {
                system_message(elgg_echo("Missing Company"));
                forward('/qis/dashboard');
	}
	$qis_groups = elgg_get_entities(array( 'type' => 'group', 'full_view' => false,));
	$title = elgg_echo('Manage Original Document');
	$content = elgg_view_form('qis/manage_original_document', 
			array('enctype' => 'multipart/form-data'),
			array(
				'access_id' => $access_id,
				'employee_guid' => $employee_guid,
				'group_guid'=> $group_guid,
				'qis_groups'=> $qis_groups,
	));
	$params = array(
	        'content' => $content,
	        'title' => $title,
	);
	$body = elgg_view_layout('one_column', $params);
	
	echo elgg_view_page($title, $body);
}
