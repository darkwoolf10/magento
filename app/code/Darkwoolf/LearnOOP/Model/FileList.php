<?php

namespace Darkwoolf\LearnOOP\Model;

use RecursiveIteratorIterator;

/**
 * Class FileList
 * @package Darkwoolf\LearnOOP\Model
 */
class FileList
{
    /**
     * @var \Magento\Framework\Filesystem\DirectoryList
     */
    protected $_dir;

    /**
     * FileList constructor.
     * @param \Magento\Framework\Filesystem\DirectoryList $dir
     */
    public function __construct(\Magento\Framework\Filesystem\DirectoryList $dir)
    {
        $this->_dir = $dir;
    }

    /**
     * @return \RecursiveIteratorIterator
     */
    public function giveFileList(): RecursiveIteratorIterator
    {
        $myPath = $this->_dir->getRoot() . '/app/code/';

        $iterator = new \RecursiveDirectoryIterator($myPath);
        $fileList = new \RecursiveIteratorIterator($iterator);

        return $fileList;
    }
}
