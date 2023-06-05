<?php

/**
 * Imap2AbraFlexi
 *
 * @author     Vítězslav Dvořák <info@vitexsofware.cz>
 * @copyright  (G) 2023 Vitex Software
 */

namespace AbraFlexi\Import;

use \Ease\Shared;

define('EASE_APPNAME','AbraFlexi-IsdocImporter') ;

require_once '../vendor/autoload.php';

/** import all configuratons from ../.env file */

Shared::init(['ABRAFLEXI_URL','ABRAFLEXI_LOGIN', 'ABRAFLEXI_PASSWORD','ABRAFLEXI_COMPANY','IMPORTDIR'],'../.env');

$imp = new Importer();
$imp->logBanner(Shared::appName());
$imp->initPath($argv[1]);
$imp->import();
$imp->addStatusMessage(_('Done'), 'success');   // Add status message
$imp->addStatusMessage(_('Imported') . ': ' . $imp->getImportedCount(), 'success');   // Add status message

