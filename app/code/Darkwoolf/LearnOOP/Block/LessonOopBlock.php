<?php

namespace Darkwoolf\LearnOOP\Block;

use Darkwoolf\LearnOOP\Model\ConstantsMethods;
use Darkwoolf\LearnOOP\Model\FileList;
use Darkwoolf\LearnOOP\Model\Parameters;
use \Magento\Framework\View\Element\Template\Context;

class LessonOopBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var FileList
     */
    private $fileList;

    /**
     * @var ConstantsMethods
     */
    private $constantsAndMethods;

    /**
     * @var Parameters
     */
    private $parameters;

    /**
     * LessonOopBlock constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param ConstantsMethods $constantsAndMethods
     * @param FileList $fileList
     * @param Parameters $parameters
     */
    public function __construct(
        Context $context,
        ConstantsMethods $constantsAndMethods,
        FileList $fileList,
        Parameters $parameters
    ) {
        parent::__construct($context);
        $this->fileList = $fileList;
        $this->constantsAndMethods = $constantsAndMethods;
        $this->parameters = $parameters;
    }

    /**
     * @return \RecursiveIteratorIterator
     */
    public function getFileList(): \RecursiveIteratorIterator
    {
        return $this->fileList->getFileList();
    }

    /**
     * @param int $IS_PUBLIC
     * @return array
     */
    public function getMethods(int $IS_PUBLIC): array
    {
        return $this->constantsAndMethods->getMethods();
    }

    /**
     * @return array
     */
    public function getConstants(): array
    {
        return $this->constantsAndMethods->getConstants();
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters->getParameters();
    }
}
