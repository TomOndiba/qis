<?php
/**
 * File renderer.
 *
 * @package ElggFile
 */

$full = elgg_extract('full_view', $vars, FALSE);
$file = elgg_extract('citizenship', $vars, FALSE);
$user_guid = elgg_extract('user_guid', $vars, FALSE);
$group_guid = elgg_extract('group_guid', $vars, FALSE);

if (!$file) {
	return TRUE;
}

$country = $file->country;
$number = $file->number;
$dateformat = elgg_echo("profile_manager:datepicker:input:dateformat");
$date_of_issue = preg_replace('/ \(.+$/','',$file->date_of_issue);
$nice_date_of_issue =  strftime($dateformat, strtotime($date_of_issue));
$expiry_date = preg_replace('/ \(.+$/','',$file->expiry_date);
$nice_expiry_date =  strftime($dateformat, strtotime($expiry_date));

$container = $file->getContainerEntity();
$mime = $file->mimetype;
$base_type = substr($mime, 0, strpos($mime,'/'));

$mod_but .= elgg_view('input/submit', array('value' => elgg_echo('modify_delete')));
$mod_form .= elgg_view('input/form', array('body' => $mod_but, 'action' => "{$CONFIG->url}qis/manage_citizenship/$group_guid/$user_guid/$file->guid"));

echo "<tr><td>$country</td><td>$number</td><td>".elgg_view_entity_icon($file, 'small')."</td><td>$nice_date_of_issue</td><td>$nice_expiry_date</td><td>$mod_form</td></tr>";
