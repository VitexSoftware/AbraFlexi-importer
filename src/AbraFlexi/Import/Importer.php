<?php

/**
 * Imap2AbraFlexi Import 
 *
 * @author     Vítězslav Dvořák <info@vitexsofware.cz>
 * @copyright  (G) 2019-2023 Vitex Software
 */

namespace AbraFlexi\Import;

use AbraFlexi\FakturaPrijata;

/**
 * Push isdoc files to AbraFlexi using https://podpora.flexibee.eu/cs/articles/6707949-import-faktury-ve-formatu-isdoc-pres-rest-api
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class Importer extends FakturaPrijata
{

    /**
     * Path to file or directory
     * @var string
     */
    public $path = null;

    /**
     * Importer file dir mode
     * 
     * @var string
     */
    public $mode = 'file';

    /**
     * List of files to import
     * @var array
     */
    public $files = [];

    /**
     * Count of imported files
     * 
     * @var int
     */
    public $importedCount = 0;

    /**
     * Init Importer using AbraFlexi class AbraFlexi\FakturaPrijata
     * 
     * @param string $path    to isdoc file or directory to import
     * @param array  $options
     */
    public function __construct($path = null, $options = [])
    {
        parent::__construct(null, $options);
        if ($path) {
            $this->initPath($path);
        }
    }

    /**
     * Path to file of directory
     * 
     * @param string $path
     * 
     * @return int count of isdoc files found
     */
    public function initPath($path)
    {
        $this->path = rtrim($path, '/\\');
        if (is_null($this->path)) {
            $this->addStatusMessage(_('No path given'), 'error');
            $this->mode = null;
        }
        if (!file_exists($this->path)) {
            $this->addStatusMessage(sprintf(_('Path %s not exists'), $this->path), 'error');
            $this->mode = 'file';
            $this->files[] = $this->path;
        }
        if (is_dir($this->path)) {
            $this->addStatusMessage(sprintf(_('Path %s is directory'), $this->path), 'debug');
            $this->mode = 'dir';
            $this->files = array_merge(glob($this->path . '/*.isdoc'), glob($this->path . '/*.isdocx'));
        }
        $this->addStatusMessage(sprintf(_('%d isdoc files found in %s'), count($this->files), $this->path), count($this->files) ? 'warning' : 'success' );
        return count($this->files);
    }

    /**
     * Perform Import of files
     */
    public function import()
    {
        $this->importedCount = 0;
        if (count($this->files) > 0) {
            $this->addStatusMessage(sprintf(_('Import of %s files begin'), count($this->files)), 'info');
            foreach ($this->files as $pos => $file) {
                $this->addStatusMessage(sprintf(_('Importing  %d/%d file'), $pos, count($this->files)), 'debug');
                $this->importFile($file);
            }
        }
    }

    /**
     * Import single file
     * 
     */
    public function importFile($path = null)
    {
        if (is_null($path)) {
            $path = $this->path;
        }
        $this->addStatusMessage(sprintf(_('Importing file %s'), $path), 'debug');
        if ($this->uploadIsdoc($path)) {
            $this->importedCount++;
        }
        $this->addStatusMessage(sprintf(_('Imported file %s'), $path), 'debug');
    }

    public function uploadIsdoc($filePath)
    {
        /**
         * Post raw invoice data
         */
        $backupFormat = $this->format;
//        $this->format = 'isdoc';
//        $this->updateApiURL();
        $this->postFields = file_get_contents($filePath);
        try {
            $response = $this->performRequest($this->getApiURL('isdoc'), 'PUT');
        } catch (\AbraFlexi\Exception $exc) {
            $response = false;
        }
        $this->format = $backupFormat;
        if ($response) {
            $this->addStatusMessage(sprintf(_('Imported file %s'), $filePath), 'debug');
        }
        return $response;
    }

    /**
     * Get count of imported files
     */
    public function getImportedCount()
    {
        return $this->importedCount;
    }
}
