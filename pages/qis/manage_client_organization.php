<?php

if (elgg_is_logged_in()) {
        $group_guid = get_input('qis_group_guid');
        if (! $group_guid) {
                system_message(elgg_echo("missing_group_guid"));
                forward('/qis/account_manager_dashboard');
        }
        $group = get_entity($group_guid);
        $access_id = $group->group_acl;

	$context = elgg_get_context();
	elgg_set_context('manage_client_organization');
	$submitter = elgg_get_logged_in_user_entity();
	$request_guid = (int) get_input('request_guid');
	
	$title = elgg_echo('Manage Client Organization - ').$group->name;
	
	
	$params = array(
	        'content' => $content,
	        'title' => $title,
	);
	$body = elgg_view_layout('one_column', $params);
	echo elgg_view_page($title, $body);
	elgg_set_context($context);
}
