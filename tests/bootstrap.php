<?php

/**
 * AbraFlexi - nastavení testů.
 *
 * @author     Vítězslav Dvořák <vitex@arachne.cz>
 * @copyright  2015-2023 Spoje.Net
 */
/**
 * Predefined server:One of:
 *
 * official|vitexsoftware|localhost
 */
$testServer = 'vitexsoftware';

include_once file_exists('../vendor/autoload.php') ? '../vendor/autoload.php' : 'vendor/autoload.php';

/**
 * Write logs as:
 */
if (!defined('EASE_APPNAME')) {
    define('EASE_APPNAME', 'AbraFlexiTest');
}
if (!defined('EASE_LOGGER')) {
    define('EASE_LOGGER', 'syslog');
}


switch ($testServer) {
    case 'official':
////
//// Config for official test server
////

        /*
         * URL AbraFlexi API
         */
        define('ABRAFLEXI_URL', 'https://demo.flexibee.eu');
        /*
         * Uživatel AbraFlexi API
         */
        define('ABRAFLEXI_LOGIN', 'winstrom');
        /*
         * Heslo AbraFlexi API
         */
        define('ABRAFLEXI_PASSWORD', 'winstrom');
        /*
         * Společnost v AbraFlexi
         */
        define('ABRAFLEXI_COMPANY', 'demo');


        break;
    case 'vitexsoftware':
//
// Config for Spoje.Net
//

        /*
         * URL AbraFlexi API
         */
        define('ABRAFLEXI_URL', 'https://vitexsoftware.flexibee.eu:5434');
        /*
         * Uživatel AbraFlexi API
         */
        define('ABRAFLEXI_LOGIN', 'flexipeehp');
        /*
         * Heslo AbraFlexi API
         */
        define('ABRAFLEXI_PASSWORD', '8Ojeton_');
        /*
         * Společnost v AbraFlexi
         */
        define('ABRAFLEXI_COMPANY', 'flexipeehp');


        break;

    default:
//
// Config for localhost
//

        /*
         * URL AbraFlexi API
         */
        define('ABRAFLEXI_URL', 'https://localhost:5434');
        /*
         * Uživatel AbraFlexi API
         */
        define('ABRAFLEXI_LOGIN', 'admin');
        /*
         * Heslo AbraFlexi API
         */
        define('ABRAFLEXI_PASSWORD', 'admin123');
        /*
         * Společnost v AbraFlexi
         */
        define('ABRAFLEXI_COMPANY', 'testing_s_r_o_');

        break;
}


define('ISDOC_FILE', __DIR__ . '/Faktura_VF1_6877_2020.isdoc');
define('ISDOCX_FILE', __DIR__ . '/Faktura_VF1_6877_2020.isdocx');
define('ACCEPT_PROVIDER_IDS', '04700813,29034736');
define('DENY_PROVIDER_IDS', '69438676');
