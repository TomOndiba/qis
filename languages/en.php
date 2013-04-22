<?php
/**
 * The Wire English language file
 */

$english = array(

	/**
	Profile manager date format overload
	*/
	'profile_manager:datepicker:trigger' => 'Select a date',
	'profile_manager:datepicker:output:dateformat' => '%Y/%m/%d', // For available notations see http://nl.php.net/manual/en/function.strftime.php
	'profile_manager:datepicker:input:localisation' => '', // change it to the available localized js files in custom_profile_fields/vendors/jquery.datepick.package-3.5.2 (e.g. jquery.datepick-nl.js), leave blank for default
	'profile_manager:datepicker:input:dateformat' => '%Y/%m/%d', // Notation is based on strftime, but must result in output like http://keith-wood.name/datepick.html#format
	'profile_manager:datepicker:input:dateformat_js' => 'yyyy/mm/dd', // Notation is based on strftime, but must result in output like http://keith-wood.name/datepick.html#format
	'profile_manager:input:multi_select:empty_text' => 'Please select ...',

	/**
	 * Menu items and titles
	 */
	'thewire' => "The Wire",
	'thewire:everyone' => "All wire posts",
	'thewire:user' => "%s's wire posts",
	'thewire:friends' => "Friends' wire posts",
	'thewire:reply' => "Reply",
	'thewire:replying' => "Replying to %s (@%s) who wrote",
	'thewire:thread' => "Thread",
	'thewire:charleft' => "characters remaining",
	'thewire:tags' => "Wire posts tagged with '%s'",
	'thewire:noposts' => "No wire posts yet",
	'item:object:thewire' => "Wire posts",
	'thewire:update' => 'Update',
	'thewire:by' => 'Wire post by %s',

	'thewire:previous' => "Previous",
	'thewire:hide' => "Hide",
	'thewire:previous:help' => "View previous post",
	'thewire:hide:help' => "Hide previous post",

	/**
	 * The wire river
	 */
	'river:create:object:thewire' => "%s posted to the %s",
	'thewire:wire' => 'wire',

	/**
	 * Wire widget
	 */
	'thewire:widget:desc' => 'Display your latest wire posts',
	'thewire:num' => 'Number of posts to display',
	'thewire:moreposts' => 'More wire posts',

	/**
	 * Status messages
	 */
	'thewire:posted' => "Your message was successfully posted to the wire.",
	'thewire:deleted' => "The wire post was successfully deleted.",
	'thewire:blank' => "Sorry, you need to enter some text before we can post this.",
	'thewire:notfound' => "Sorry, we could not find the specified wire post.",
	'thewire:notdeleted' => "Sorry. We could not delete this wire post.",

	/**
	 * Notifications
	 */
	'thewire:notify:subject' => "New wire post",
	'thewire:notify:reply' => '%s responded to %s on the wire:',
	'thewire:notify:post' => '%s posted on the wire:',
    
        /**
         * Menu items
         */
        'manage_client_organizations' => "Manage Client Organizations",
        'view_reports' => "View Reports",
        'receive_original_documents' => "Receive Original Documents",
        'manage_persons' => "Manage Persons",
        'add_person' => "Add Person",
        'manage_immigration_requests' => "Manage Immigration Requests",
        'request_resident_permit' => "Request Resident Permit",
        'manage_corporate_information' => "Manage Corporate Information",
        'manage_quota_requests' => "Manage Quota Requests",
        'add_quota_request' => "Add Quota Request",
        'manage_documents' => "Manage Documents",
        'manage_visits' => "Manage Visits",
        'manage_quotas' => "Manage Quotas",
    
        /**
         * TODO List
         */
        'need_visa_info_for' => "Need visa info for ",
        'need_quota_request_for' => "Need quota request for ",
        'need_noc_for' => "Need NOC for ",
        'need__additional_quota_request_for' => "Need additional quota request for ",
        'check_passport_photocopy_for_request_id' => "Check passport photocopy for request_id ",
        'check_registration_card_for_request_id' => "Check registration card for request_id ",
        'check_passport_photocopy_for_request_id' => "Check passport photocopy for request_id ",
        'check_registration_card_for_request_id' => "Check registration card for request_id ",
        'check_labour_contract_for_request_id' => "Check labour contract for request_id ",
        'schedule_medical_for' => "Schedule medical for ",
        'schedule_blood_test_for' => "Schedule blood test for ",
        'schedule_fingerprinting_for' => "Schedule fingerprinting for "

);

add_translation("en", $english);
