<?php
namespace WebsiteNEO\SelectConnect\SCADMIN;

if (!defined('ABSPATH')) {
    exit('No');
}

if (class_exists('WebsiteNEO\SelectConnect')) {
    exit('No SC');
}



//require_once 'src/common/class-ajax.php';
require_once 'class-ajax.php';
require_once SCADMIN_DIR."/src/admin/class-admin-settings.php";


if (is_admin()) {    
    // $adminPage = new \WebsiteNEO\SelectConnect\SCADMIN\Settings\Admin_Settings;
    \WebsiteNEO\SelectConnect\SCADMIN\Settings\Admin_Settings::setup();
}
