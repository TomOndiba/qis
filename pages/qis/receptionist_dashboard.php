<?php
if (elgg_is_logged_in()) {
        $group_guid = get_input('qis_group_guid');
	/*
        if (! $group_guid) {
                system_message(elgg_echo("missing_group_guid"));
                forward('/qis/dashboard');
        }
        $group = get_entity($group_guid);
        $access_id = $group->group_acl;
	*/
	$user = elgg_get_logged_in_user_entity();

	$title = elgg_echo('Receptionist Dashboard');
	
	$content=elgg_view('qis/receptionist_tasks', array());
	$content.=elgg_view_menu('qis', array('sort_by' => 'priority'));
	$body = elgg_view_layout('one_column', array(
		'content' => $content,
		'title' => $title,
	));
	echo elgg_view_page($title, $body);
}
