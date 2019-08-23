<?php

namespace Darkwoolf\LearnOOP\Model;

use RecursiveIteratorIterator;
use \Magento\Framework\Filesystem\DirectoryList;

/**
 * Class FileList
 * @package Darkwoolf\LearnOOP\Model
 */
class FileList
{
    /**
     * @var DirectoryList
     */
    protected $dir;

    /**
     * FileList constructor.
     * @param DirectoryList $dir
     */
    public function __construct(DirectoryList $dir)
    {
        $this->dir = $dir;
    }

    /**
     * @return RecursiveIteratorIterator
     */
    public function getFileList(): RecursiveIteratorIterator
    {
        $myPath = $this->dir->getRoot() . '/app/code/';

        $iterator = new \RecursiveDirectoryIterator($myPath);
        $fileList = new \RecursiveIteratorIterator($iterator);

        return $fileList;
    }
}
