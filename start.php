<?php
elgg_register_event_handler('init', 'system', 'qis_init');

/**
 * The Wire initialization
 */
function qis_init() {

	 elgg_register_library('elgg:qis', elgg_get_plugins_path() . 'qis/lib/qis.php');
	//elgg_register_plugin_hook_handler('roles:config','role','qis_roles_config',501);
	// for md only
	//elgg_register_plugin_hook_handler('permissions_check:metadata', 'user', 'qis_permissions_override');
	// for whole entities
	elgg_register_plugin_hook_handler('permissions_check', 'user', 'qis_user_permissions_override');
	elgg_register_plugin_hook_handler('permissions_check', 'object', 'qis_file_permissions_override');
	//Register group library
	elgg_register_library('elgg:groups', elgg_get_plugins_path() . 'groups/lib/groups.php');
	//elgg_register_plugin_hook_handler('permissions_check:group', 'user', 'qis_group_permissions_override');
	// register the wire's JavaScript
	$qis_js = elgg_get_simplecache_url('js', 'qis');
	elgg_register_simplecache_view('js/qis');
	elgg_register_js('elgg.qis', $qis_js);
	elgg_extend_view('css/elgg', 'qis/css');
	//Index page handler
	elgg_register_plugin_hook_handler('index', 'system', 'qis_index_handler');
	//Page handlers
	// Register a page handler, so we can have nice URLs
	elgg_register_page_handler('qis', 'qis_page_handler');
	elgg_register_page_handler('get_citizenship_docs', 'get_citizenship_docs');
	elgg_register_page_handler('get_requests', 'get_requests');
	elgg_register_page_handler('get_employees', 'get_employees');
	//elgg_register_ajax_view('thewire/previous');

	// owner block menu
	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'qis_owner_block_menu');

	// remove edit and access and add thread, reply, view previous
//	elgg_register_plugin_hook_handler('register', 'menu:entity', 'thewire_setup_entity_menu_items');
	
	// Extend system CSS with our own styles, which are defined in the thewire/css view
	elgg_extend_view('css/elgg', 'qis/css');

	//extend views
	//elgg_extend_view('activity/thewire', 'thewire/activity_view');
	//elgg_extend_view('profile/status', 'thewire/profile_status');
	//elgg_extend_view('js/initialise_elgg', 'thewire/js/textcounter');


	// Register a URL handler for thewire posts
	elgg_register_entity_url_handler('object', 'qis', 'qis_url');

	// Register for search
	elgg_register_entity_type('object', 'qisResidentPermitRequest');
	elgg_register_entity_type('object', 'qisQuotaRequest');
	elgg_register_entity_type('object', 'qisResidentPermit');
	elgg_register_entity_type('object', 'qisQuota');
	add_subtype('object', 'quota', 'qisQuota');

	// Register granular notification for this type
	//register_notification_object('object', 'thewire', elgg_echo('thewire:notify:subject'));

	// Listen to notification events and supply a more useful message
	//elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'thewire_notify_message');

	// Register actions
	$action_base = elgg_get_plugins_path() . 'qis/actions/qis';
	elgg_register_action("qis/manage_citizenship", "$action_base/manage_citizenship.php");
	elgg_register_action("qis/manage_corporate_info", "$action_base/manage_corporate_info.php");
	elgg_register_action("qis/manage_document", "$action_base/manage_document.php");
	elgg_register_action("qis/manage_original_document", "$action_base/manage_original_document.php");
	elgg_register_action("qis/manage_person", "$action_base/manage_person.php");
	elgg_register_action("qis/manage_quota", "$action_base/manage_quota.php");
	elgg_register_action("qis/manage_quota_request", "$action_base/manage_quota_request.php");
	elgg_register_action("qis/manage_rp_request", "$action_base/manage_rp_request.php");
	elgg_register_action("qis/manage_visit", "$action_base/manage_visit.php");
	elgg_register_action("qis/manage_wv_request", "$action_base/manage_wv_request.php");
	//custom look
	elgg_unregister_menu_item('topbar', 'elgg_logo');
}

// Index page handler
function qis_index_handler() {
        if (elgg_is_logged_in()) {
		$user = elgg_get_logged_in_user_entity();
		if ($user->qisusertype == 'Immigration Agency Portal Coordinator') {
                	forward('qis/admin_dashboard');
		} elseif ($user->qisusertype == 'Immigration Agency Account Manager') {
                	forward('qis/account_manager_dashboard');
		} elseif ($user->qisusertype == 'Client Portal Administrator') {
                	forward('qis/dashboard');
		} elseif ($user->qisusertype == 'Immigration Agency Receptionist') {
                	forward('qis/receptionist_dashboard');
		}
        } else {
            $login_box = elgg_view('core/account/login_box');
            elgg_set_page_owner_guid(1);
            $content = elgg_view('page/elements/login_buttons', $vars);
            $body = elgg_view_layout('two_sidebar_river', array( 'title' => $title, 'sidebar'=> $login_box, 'content' => $content));
            echo elgg_view_page($title, $body);
        }
}

function qis_page_handler($page) {

        if (elgg_is_logged_in()) {
		$user = elgg_get_logged_in_user_entity();
	}
	$base_dir = elgg_get_plugins_path() . 'qis/pages/qis';

	if (!isset($page[0])) {
		$page = array('dashboard');
	}

	$qis_group_guid = get_input('qis_group_guid');
	//elgg_log('BRUNO page[1]='.$page[1].'qis_group_guid='.$qis_group_uid.'page[0]='.$page[0],'NOTICE');
	if ((!isset($page[1])) && (! $qis_group_guid) && (($page[0] != 'admin_dashboard') &&
							  ($page[0] != 'account_manager_dashboard') &&
							  ($page[0] != 'receptionist_dashboard') &&
							  ($page[0] != 'manage_original_documents') &&
							  ($page[0] != 'manage_original_document') &&
							  ($page[0] != 'manage_document'))) {
		if ($user) {
			$groups = get_users_membership ($user->guid);
			if (count($groups) == 1) {
				$group_guid = $groups[0]->guid;
				$qis_group_guid = $group_guid;
				set_input('qis_group_guid', $qis_group_guid);
			} else {
				forward('/qis/admin_dashboard');
			}
		}
	} else {
		$qis_group_guid = $page[1];
		set_input('qis_group_guid', $qis_group_guid);
	}
	// add menu items
	if ($user->qisusertype == 'Immigration Agency Account Manager') {
		elgg_register_menu_item('qis', array(
				'name' => 'manage_client_organizations',
				'href' => "qis/manage_client_organizations/$qis_group_guid",
				'text' => elgg_echo('manage_client_organizations'),
				'title' => elgg_echo('manage_client_organizations'),
				'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
				'priority' => 300,
			));
		elgg_register_menu_item('qis', array(
				'name' => 'view_reports',
				'href' => "qis/view_reports",
				'text' => elgg_echo('view_reports'),
				'title' => elgg_echo('view_reports'),
				'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
				'priority' => 310,
			));
	} elseif ($user->qisusertype == 'Immigration Agency Receptionist') {
		elgg_register_menu_item('qis', array(
				'name' => 'receive_original_documents',
				'href' => "qis/manage_original_documents/$qis_group_guid",
				'text' => elgg_echo('receive_original_documents'),
				'title' => elgg_echo('receive_original_documents'),
				'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
				'priority' => 300,
			));
	} else {
		elgg_register_menu_item('qis', array(
        	                'name' => 'manage_persons',
        	                'href' => "qis/manage_persons/$qis_group_guid",
        	                'text' => elgg_echo('manage_persons'),
        	                'title' => elgg_echo('manage_persons'),
        	                'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
        	                'priority' => 300,
        	        ));
		elgg_register_menu_item('qis', array(
        	                'name' => 'add_person',
        	                'href' => "qis/manage_person/$qis_group_guid",
        	                'text' => elgg_echo('add_person'),
        	                'title' => elgg_echo('add_person'),
        	                'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
        	                'priority' => 310,
        	        ));
		elgg_register_menu_item('qis', array(
        	                'name' => 'manage_immigration_requests',
        	                'href' => "qis/manage_immigration_requests/$qis_group_guid",
        	                'text' => elgg_echo('manage_immigration_requests'),
        	                'title' => elgg_echo('manage_immigration_requests'),
        	                'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
        	                'priority' => 330,
        	        ));
		elgg_register_menu_item('qis', array(
        	                'name' => 'request_resident_permit',
        	                'href' => "qis/manage_rp_request/$qis_group_guid",
        	                'text' => elgg_echo('request_resident_permit'),
        	                'title' => elgg_echo('request_resident_permit'),
        	                'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
        	                'priority' => 340,
        	        ));
		elgg_register_menu_item('qis', array(
        	                'name' => 'manage_corporate_information',
        	                'href' => "qis/manage_corporate_info/$qis_group_guid",
        	                'text' => elgg_echo('manage_corporate_information'),
        	                'title' => elgg_echo('manage_corporate_information'),
        	                'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
        	                'priority' => 350,
        	        ));
		elgg_register_menu_item('qis', array(
        	                'name' => 'manage_quota_requests',
        	                'href' => "qis/manage_quota_requests/$qis_group_guid",
        	                'text' => elgg_echo('manage_quota_requests'),
        	                'title' => elgg_echo('manage_quota_requests'),
        	                'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
        	                'priority' => 360,
        	        ));
		elgg_register_menu_item('qis', array(
        	                'name' => 'manage_quota_request',
        	                'href' => "qis/manage_quota_request/$qis_group_guid",
        	                'text' => elgg_echo('add_quota_request'),
        	                'title' => elgg_echo('add_quota_request'),
        	                'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
        	                'priority' => 370,
        	        ));
		elgg_register_menu_item('qis', array(
        	                'name' => 'manage_documents',
        	                'href' => "qis/manage_documents/$qis_group_guid",
        	                'text' => elgg_echo('manage_documents'),
        	                'title' => elgg_echo('manage_documents'),
        	                'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
        	                'priority' => 380,
        	        ));
		if ($user->qisusertype == 'Immigration Agency Portal Coordinator') {
			elgg_register_menu_item('qis', array(
        		                'name' => 'manage_visits',
        		                'href' => "qis/manage_visits/$qis_group_guid",
        		                'text' => elgg_echo('manage_visits'),
        		                'title' => elgg_echo('manage_visits'),
        		                'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
        		                'priority' => 390,
        		        ));
			elgg_register_menu_item('qis', array(
        		                'name' => 'manage_quotas',
        		                'href' => "qis/manage_quotas/$qis_group_guid",
        		                'text' => elgg_echo('manage_quotas'),
        		                'title' => elgg_echo('manage_quotas'),
        		                'class' => "elgg-button elgg-button-submit elgg-button-dashboard",
        		                'priority' => 400,
        		        ));
		}
	}

	switch ($page[0]) {
		case "account_manager_dashboard":
			include "$base_dir/account_manager_dashboard.php";
			break;

		case "activate":
			include "$base_dir/activate.php";
			break;

		case "admin_dashboard":
			include "$base_dir/admin_dashboard.php";
			break;

		case "view_person":
			if (isset($page[2])) {
				set_input('guid', $page[2]);
			}
			include "$base_dir/ajax/view_person.php";
			break;

		case "create_countries":
			include "$base_dir/create_countries.php";
			break;

		case "create_occupations":
			include "$base_dir/create_occupations.php";
			break;

		case "dashboard":
			include "$base_dir/dashboard.php";
			break;

		case "deactivate":
			include "$base_dir/deactivate.php";
			break;

		case "manage_citizenship":
			if (isset($page[2])) {
				set_input('user_guid', $page[2]);
			}
			if (isset($page[3])) {
				set_input('guid', $page[3]);
			}
			include "$base_dir/manage_citizenship.php";
			break;

		case "manage_client_organization":
			include "$base_dir/manage_client_organization.php";
			break;

		case "manage_client_organizations":
			include "$base_dir/manage_client_organizations.php";
			break;

		case "manage_corporate_info":
			elgg_load_library('elgg:groups');
			include "$base_dir/manage_corporate_info.php";
			break;

		case "manage_document":
			if (isset($page[1])) {
				set_input('qis_group_guid', $page[1]);
				if (isset($page[2])) {
					set_input('fich_guid', $page[2]);
					elgg_log("BRUNO start fich_guid=$page[2]",'NOTICE');
				}
			}
			include "$base_dir/manage_document.php";
			break;

		case "manage_documents":
			include "$base_dir/manage_documents.php";
			break;

		case "manage_immigration_services":
			include "$base_dir/manage_immigration_services.php";
			break;

		case "manage_immigration_requests":
			if (isset($page[2])) {
				set_input('request_guid', $page[2]);
				set_input('expli', $page[3]);
			}
			include "$base_dir/manage_immigration_requests.php";
			break;

		case "manage_original_document":
			if (isset($page[1])) {
				set_input('qis_group_guid', $page[1]);
				if (isset($page[2])) {
					set_input('fich_guid', $page[2]);
					elgg_log("BRUNO start fich_guid=$page[2]",'NOTICE');
				}
			}
			include "$base_dir/manage_original_document.php";
			break;

		case "manage_original_documents":
			if (isset($page[1])) {
				set_input('qis_group_guid', $page[1]);
				if (isset($page[2])) {
					set_input('fich_guid', $page[2]);
					elgg_log("BRUNO start fich_guid=$page[2]",'NOTICE');
				}
			}
			include "$base_dir/manage_original_documents.php";
			break;

		case "manage_person":
			if (isset($page[2])) {
				set_input('guid', $page[2]);
			}
			include "$base_dir/manage_person.php";
			break;

		case "manage_persons":
			include "$base_dir/manage_persons.php";
			break;

		case "manage_quotas":
			include "$base_dir/manage_quotas.php";
			break;

		case "manage_quota_request":
			if (isset($page[2])) {
				set_input('request_guid', $page[2]);
			}
			include "$base_dir/manage_quota_request.php";
			break;

		case "manage_quota_requests":
			include "$base_dir/manage_quota_requests.php";
			break;

		case "manage_rp_request":
			if (isset($page[2])) {
				set_input('request_guid', $page[2]);
			}
			include "$base_dir/manage_rp_request.php";
			break;

		case "manage_visit":
			if (isset($page[2])) {
				set_input('request_guid', $page[2]);
			}
			include "$base_dir/manage_visit.php";
			break;

		case "manage_visits":
			include "$base_dir/manage_visits.php";
			break;

		case "manage_wv_request":
			if (isset($page[2])) {
				set_input('request_guid', $page[2]);
			}
			include "$base_dir/manage_wv_request.php";
			break;

		case "receptionist_dashboard":
			include "$base_dir/receptionist_dashboard.php";
			break;

		case "request_resident_permit":
			include "$base_dir/request_resident_permit.php";
			break;

		case "request_tracker":
			if (isset($page[2])) {
				set_input('request_guid', $page[2]);
			}
			include "$base_dir/request_tracker.php";
			break;

		case "view":
			if (isset($page[2])) {
				set_input('guid', $page[2]);
			}
			include "$base_dir/view.php";
			break;

		case "view_reports":
			include "$base_dir/view_reports.php";
			break;

		default:
			return false;
	}
	return true;
}

function qis_user_permissions_override($hook_name, $entity_type, $return_value, $params) {
	if (elgg_get_context() == 'manage_person') {
	$user = $params['user'];
	if ($user) {
		$user_groups = get_users_membership ($user->guid);
		if ($user_groups) {
			if (check_entity_relationship($user->getGUID(), "group_admin", $user_groups[0]->getGUID())) {
				return true;
			} else {
				return null;
			}
		}
	}
	}
	return null;
}

function qis_file_permissions_override($hook_name, $entity_type, $return_value, $params) {
	if ((elgg_get_context() == 'manage_citizenship') ||
	    (elgg_get_context() == 'manage_rp_request')) {
	$user = $params['user'];
	$object = $params['entity'];
	if ($user && $object) {
		$user_groups = get_users_membership ($user->guid);
		if ($user_groups) {
			if (check_entity_relationship($user->getGUID(), "group_admin", $user_groups[0]->getGUID())) {
				return true;
			} else {
				return null;
			}
		}
	}
	}
	return null;
}

function qis_group_permissions_override($hook_name, $entity_type, $return_value, $params) {
	$user = $params['user'];
	if ($user) {
		$user_groups = get_users_membership ($user->guid);
		if ($user_groups) {
			if (check_entity_relationship($user->getGUID(), "group_admin", $user_groups[0]->getGUID())) {
				return true;
			} else {
				return false;
			}
		}
	}
}

function qis_roles_config($hook_name, $entity_type, $return_value, $params) {
	$roles = array(
		’portal_administrator’ => array(
			'title' => 'qis_company_portal_administrator',
			'permissions' => array(
				'actions' => array(
					'profile/edit' => array('rule' => 'allow')
				),
                                'views' => array(
					'admin/users/add' => array('rule' => 'allow'),
					'profile/edit' => array('rule' => 'allow')
				),
			),
		)
	);
	if (!is_array($return_value)) {
		return $roles;
	} else {
		return array_merge($return_value, $roles);
	}
}

function get_citizenship_docs() {
        require_once elgg_get_plugins_path() . 'qis/lib/get_citizenship_docs.php';
        return true;
}
function get_requests() {
        require_once elgg_get_plugins_path() . 'qis/lib/get_requests.php';
        return true;
}
function get_employees() {
        require_once elgg_get_plugins_path() . 'qis/lib/get_employees.php';
        return true;
}
