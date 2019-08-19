<?php

namespace Darkwoolf\LearnOOP\Block;

use Darkwoolf\LearnOOP\Model\ConstantsMethods;
use Darkwoolf\LearnOOP\Model\FileList;
use Darkwoolf\LearnOOP\Model\Parameters;

class LessonOopBlock extends \Magento\Framework\View\Element\Template
{
    /**
     * @var FileList
     */
    public $fileListGet;

    /**
     * @var ConstantsMethods
     */
    public $constantsAndMethodsGet;

    /**
     * @var Parameters
     */
    public $parametersGet;

    /**
     * LessonOopBlock constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param ConstantsMethods $constantsAndMethods
     * @param FileList $fileList
     * @param Parameters $parameters
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        ConstantsMethods $constantsAndMethods,
        FileList $fileList,
        Parameters $parameters
    ) {
        parent::__construct($context);
        $this->fileListGet = $fileList;
        $this->constantsAndMethodsGet = $constantsAndMethods;
        $this->parametersGet = $parameters;
    }

    /**
     * @return \RecursiveIteratorIterator
     */
    public function giveFileList(): \RecursiveIteratorIterator
    {
        return $this->fileListGet->giveFileList();
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getMethods(): array
    {
        return $this->constantsAndMethodsGet->getMethods();
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getConstants(): array
    {
        return $this->constantsAndMethodsGet->getConstants();
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parametersGet->getParameters();
    }
}
