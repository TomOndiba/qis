<?php
$dateformat = elgg_echo("profile_manager:datepicker:input:dateformat");
$dob = preg_replace('/ \(.+$/','',$vars['entity']->dob);
$nice_dob =  strftime($dateformat, strtotime($dob));
?>
<div class='user-first-line'>
	<label><?php echo elgg_echo('Firstname'); ?></label>
	<p><?php echo elgg_echo($vars['entity']->firstname); ?></p>
</div>
<div class='user-first-line'>
        <label><?php echo elgg_echo('Middlename'); ?></label>
        <p><?php echo $vars['entity']->middlename ?></p>
</div>
<div class='user-first-line'>
        <label><?php echo elgg_echo('Lastname'); ?></label>
        <p><?php echo $vars['entity']->lastname ?></p>
</div>
<div class='user-first-line'>
        <label><?php echo elgg_echo('Gender'); ?></label>
        <p><?php echo $vars['entity']->gender ?></p>
</div>
<div class='user-first-line'>
        <label><?php echo elgg_echo('Date of Birth'); ?></label>
        <p><?php echo $nice_dob ?></p>
</div>
<div class='user-first-line'>
        <label><?php echo elgg_echo('Place of Birth'); ?></label>
        <p><?php echo $vars['entity']->pob ?></p>
</div>
