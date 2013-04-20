<?php
if (elgg_is_logged_in()) {
	$user = elgg_get_logged_in_user_entity();
	if (! $user->isAdmin()) {
		register_error(elgg_echo("qis:not_an_admin"));
		forward();
	}
	
	$title = elgg_echo('Manage Client Organization');
	//list all groups
	$qis_groups = elgg_get_entities(array( 'type' => 'group', 'full_view' => false,));
	if (!$qis_groups) {
		$content = elgg_echo('groups:none');
	} else {
		$content=elgg_view('qis/client_organizations', array('qis_groups' => $qis_groups,'user' => $user));
	}
	$mod_but = elgg_view('input/submit', array('value' => elgg_echo('Manage Service Agreements')));
	$view_form = elgg_view('input/form', array('body' => $mod_but, 'action' => ""));
	$content = $view_form;
	$content .= '<br>';
	$mod_but = elgg_view('input/submit', array('value' => elgg_echo('Manage Quotas')));
	$view_form = elgg_view('input/form', array('body' => $mod_but, 'action' => ""));
	$content .= $view_form;
	$content .= '<br>';
	$mod_but = elgg_view('input/submit', array('value' => elgg_echo('View Service Consumption')));
	$view_form = elgg_view('input/form', array('body' => $mod_but, 'action' => ""));
	$content .= $view_form;
	$content .= '<br>';
	$mod_but = elgg_view('input/submit', array('value' => elgg_echo('View Organization Documents')));
	$view_form = elgg_view('input/form', array('body' => $mod_but, 'action' => ""));
	$content .= $view_form;
	$content .= '<br>';
	$mod_but = elgg_view('input/submit', array('value' => elgg_echo('View Employees')));
	$view_form = elgg_view('input/form', array('body' => $mod_but, 'action' => ""));
	$content .= $view_form;
	$content .= '<br>';
	$mod_but = elgg_view('input/submit', array('value' => elgg_echo('Return to main Portal')));
	$view_form = elgg_view('input/form', array('body' => $mod_but, 'action' => "/qis/account_manager_dashboard"));
	$content .= $view_form;

	$body = elgg_view_layout('one_column', array(
		'content' => $content,
		'title' => $title,
	));
	echo elgg_view_page($title, $body);
}
