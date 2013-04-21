@font-face {
    font-family: "DINPro";
    src: local("DINPro"), url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/DINPro-Regular.otf) format("opentype");
}

@font-face {
    font-family: "DINProBold";
    src: local("DINPro-Bold"), url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/DINPro-Bold.otf) format("opentype");
}

.elgg-body.qis-company-list {
 	height: 40px;
        width: 800px;
}
.elgg-page-default {
        min-width: 1024px;
}
.elgg-page-default .elgg-page-header > .elgg-inner {
        width: 1024px;
        margin: 0 auto;
        height: 90px;
}
.elgg-page-default .elgg-page-body > .elgg-inner {
        width: 1024px;
        margin: 0 auto;
}
.elgg-page-default .elgg-page-footer > .elgg-inner {
        width: 1024px;
        margin: 0 auto;
        padding: 5px 0;
        border-top: 1px solid #DEDEDE;
}

#qis-selected-user {
	margin-top: -25px;
	clear: both;
	float:right;
	width: 550px;
	position: relative;
}

#request-immigration-service {
	display: block;
	min-height: 300px;
}
#request-immigration-service > div {
	margin-bottom: 15px
}

.user-first-line, .first-line {
	float: left;
	padding: 5px;
	}

#qis-task {
	padding: 5px;
}
#qis-task-button {
	position:relative;
	left:500px;
	top:-30px;
	padding: 5px;
}
.user-first-line > p {
	float: right;
	margin: 0px 10px 0px 10px;
	outline: 1px solid;
}

#request-quota,#request-quota-more,#document-form  {
	clear: both;
}

.qis-document-form, #qis-request-dropdown , #document-upload, #document-delete {
	float: left;
	margin: 10px;
}


.quantity { width: 40%;}
.visa { width: 100px;}
.expiry { width: 100px;}

#quota-submit {
	width: 60px;
}

#qis_ris {
	border: 5px double;
	clear: both;
}

#qis_ris tr,td,th {
	border: 2px solid;
	padding: 5px;
	text-align: center;
}

.elgg-button-dashboard {
	display: inline!important;
}

.qis-user-att {
	/*float: left;*/
}

.qis-applications-in-progress,.qis-to-do {
	border: 2px solid;
	padding: 5px;
	margin-top: 10px;
	min-height: 60px;
}

.qis-applications-in-progress > h2 {
	margin-bottom: 10px;
}



#qis-message {
	background-color: red;
	color: #782434;
	font-size: 20px;
	margin: 5px;
	outline: 1px solid;
}

/*  navigation on dashboard */
.elgg-menu-qis {
        /*position: absolute;
        bottom: 0;
        left: 0;
        height: 23px;*/
	padding-top:20px;
}

.elgg-menu-qis > li {
        float: left;
        margin-right: 1px;
	padding:10px;
}

.elgg-menu-qis > li > a {
        color: white;
}

/* KAT */

.elgg-page-default
{
	min-width: 958px;
	max-width: 958px;
	height: 958px;
	width: 957px;
	position: absolute;
	left: 100px;
}

.elgg-page-header {
	position: relative;
	background: none;
}



.elgg-layout-one-sidebar {
	background: none;
}

.elgg-search-header {
	top: 160px;
	height: 23px;
	position: absolute;
	left: 850px;
}

.elgg-heading-site, .elgg-heading-site:hover {
	font-size: 26px;
	line-height: 1.4em;
	color: white;
	font-style: normal;
	font-family: Georgia, times, serif;
	text-shadow: none;
	text-decoration: none;
	position: relative;
	left: 745px;
	top: 100px;
}


.elgg-search input[type=text] {
	background-color: white;	
	color: #e7e5e1;
}

h1, h2, h4, h5, h6, .elgg-heading-basic {
	color: #782434;
}


.elgg-page-default .elgg-page-footer > .elgg-inner {
	width: 958px;
	margin: 0 auto;
	padding: 5px 0;
	border-top: none;
	position: relative;
	top: 430px;
	left: 100px;
}


.elgg-button-yahoo
{
	width:186px;
	height:217px;
	border:none;
	background-color:transparent;
        position: absolute;
	left:100px;
	top: 200px;
        background-image:url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/yahoo_btn_normal.png);
}

.elgg-button-fb
{
	width:186px;
	height:217px;
	border:none;
	background-color:transparent;
	position: absolute;
	left:300px;
	top: 200px;
	background-image:url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/fb_btn_normal.png);
}

.elgg-button-google
{
	width:186px;
	height:227px;
	border:none;
	background-color:transparent;
	position: absolute;
	left:500px;
	top: 200px;
	background-image:url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/google_btn_normal.png);
}


#login-dropdown {
        visibility:hidden;
}


.elgg-list-river {	
	visibility: hidden;
}

.elgg_powered {	
	visibility: hidden;
}


.elgg-menu-item-report-this {	
	visibility: hidden;
}

.elgg-layout-one-column {
        position: absolute;
        left: 130px;
        top: 100px;
}

.elgg-page-body {
        position: absolute;
        left: 100px;
        top: 200px;
        width: 950px;
        min-width: 950px;
        max-width: 950px;
}

.elgg-sidebar {
	position: absolute;
	float: none;
        padding: none;
	width: 220px;
	margin: 0 0 0 10px;
	left: 730px;
	top: 250px;
        z-index:1000;
}

#qis-applications-todo {
 	border:none;
	background-color:transparent;
	position: absolute;
        top: 0px;
        left: 220px;
        width: 650px;
        height: 500px;
	background-image:url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/todo_div.png);
        background-repeat: no-repeat;
}

#qis-applications-progress {
 	border:none;
	background-color:transparent;
	position: absolute;
        top: 300px;
        left: 220px;
        width: 650px;
        height: 300px;
	background-image:url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/div_apps_manage.png);
        background-repeat: no-repeat;
}

.qis-applications-todo > h3 {
	font-size: 8px;
	color: #782434;
}



.elgg-body, .elgg-main {
 	height: 600px;
        width: 800px;
}

#qis-applications-on-track {
	font-size: 48px;
	color: white;
	position: absolute;
        top: 130px;
        left: 180px;
}
#qis-applications-late {
	color: white;
	font-size: 48px;
	position: absolute;
        top: 130px;
        left: 460px;
}

.elgg-menu-qis {
 	border:none;
	background-color:transparent;
	position: absolute;
        top: 0px;
        left: 0px;
        width: 200px;
	background-image:url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/dashboard_div_left.png);
}

.elgg-menu-qis > li > a {
        background-image:url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/menu_btn.png);
        background-color: transparent;
        color: transparent;
}



.elgg-menu-item-manage-corporate-information,
.elgg-menu-item-manage-persons,
.elgg-menu-item-add-person,
.elgg-menu-item-manage-immigration-requests,
.elgg-menu-item-request-resident-permit,
.elgg-menu-item-manage-quota-requests,
.elgg-menu-item-manage-quota-request,
.elgg-menu-item-manage-documents,
.elgg-menu-qis > li > a, .elgg-menu-qis > li
{
        height: 40px;
        width: 180px;
}


h3 {
        color:#782434;
        font-size:10px;        
}


.elgg-form-login > .elgg-input-text, fieldset, .elgg-input-password{
        width: 215px;
        font-size:12px;        
}

html *
{
  font-family: DINPro !important;
  font-color: #782434 !important;
}

.elgg-button, .elgg-button:hover,
.elgg-menu-item-manage-corporate-information,
.elgg-menu-item-manage-persons,
.elgg-menu-item-add-person,
.elgg-menu-item-manage-immigration-requests,
.elgg-menu-item-request-resident-permit,
.elgg-menu-item-manage-quota-requests,
.elgg-menu-item-manage-quota-request,
.elgg-menu-item-manage-documents
{
        background-image:url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/menu_btn.png);
        border:none;
        color: transparent;
        height: 62px;
        width: 217px;
        font-size:12px;
        font-family: DINProBold !important;
        text-align: center;
        text-decoration: none;
        background-color: transparent;
        margin: none;
        -webkit-border-radius: 0px;
	-moz-border-radius: 0px;
	border-radius: 0px;
	padding: none;
        -webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
        background: transparent url(<?php echo elgg_get_site_url(); ?>mod/qis/graphics/menu_btn.png) repeat:no-repeat;
}

h3 {
	font-size: 12px;
	color: black;
}

#qis-add-person {
	position: absolute;
	left: 500px;
}

#elgg-add-buttons {
	position: absolute;
	left: 500px;
        top: 400px;
}

#qis-submit {
	position: absolute;
	left: 500px;
        top: 300px;
}

#qis_ris {
        position: absolute;
	top: 100px;
        left: 260px;
}


#elgg-manage-persons-buttons {
        position: absolute;
	top: 600px;
        left: 320px;
}

#qis_ris_big {
        position: absolute;
	top: 0px;
        left: 140px;
}

#elgg-add-buttons-quota {
        position: absolute;
	top: 460px;
        left: 120px;
}

body {
        background-repeat: no-repeat;
        background-color: #8cc6ec;
}