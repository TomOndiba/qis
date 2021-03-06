<?php
$user = elgg_get_logged_in_user_entity();
if ($user->qisusertype == 'Immigration Agency Account Manager') {
	$target = 'manage_client_organization';
} else {
	$target = 'dashboard';
}

$vars['qis_group']->setURL('/qis/dashboard/'.$vars['qis_group']->guid);
$icon = elgg_view_entity_icon($vars['qis_group'], 'small');

$title = $vars['qis_group']->title;
if (!$title) {
	$title = $vars['qis_group']->name;
}
if (!$title) {
	$title = get_class($vars['qis_group']);
}

if (elgg_instanceof($vars['qis_group'], 'object')) {
	$metadata = elgg_view('navigation/menu/metadata', $vars);
}

$owner_link = '';
$owner = $vars['qis_group']->getOwnerEntity();
if ($owner) {
	$owner_link = elgg_view('output/url', array(
		'href' => $owner->getURL(),
		'text' => $owner->name,
		'is_trusted' => true,
	));
}

$date = elgg_view_friendly_time($vars['qis_group']->time_created);

$subtitle = "$owner_link $date";

$params = array(
	'entity' => $vars['qis_group'],
	'title' => $title,
	'metadata' => $metadata,
	'subtitle' => $subtitle,
	'tags' => $vars['qis_group']->tags,
);
$params = $params + $vars;
$body = elgg_view('object/elements/summary', $params);

//echo elgg_view_image_block($icon, $body, $vars);
$group_line =  elgg_view_image_block($icon, $body, $vars);
$mod_but = elgg_view('input/submit', array('value' => elgg_echo('View')));
$view_form = elgg_view('input/form', array('body' => $mod_but, 'action' => "{$CONFIG->url}qis/$target/".$vars['qis_group']->guid));
$group_line .= $view_form;
echo $group_line;

