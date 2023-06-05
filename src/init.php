<?php

/**
 * Imap2AbraFlexi Init
 *
 * @author     Vítězslav Dvořák <info@vitexsofware.cz>
 * @copyright  (G) 2019,2022 Vitex Software
 */

namespace AbraFlexi\Imap2AF;

require_once '../vendor/autoload.php';

/** import all configuratons from ../.env file */

\Ease\Shared::init(['ABRAFLEXI_URL','ABRAFLEXI_LOGIN', 'ABRAFLEXI_PASSWORD','ABRAFLEXI_COMPANY','IMPORTDIR'],'../.env');

\Ease\Locale::singleton('cs_CZ', '../i18n', 'abraflexi-importer');

