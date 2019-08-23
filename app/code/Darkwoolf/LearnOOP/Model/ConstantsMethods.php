<?php

namespace Darkwoolf\LearnOOP\Model;

/**
 * Class ConstantsMethods
 * @package Darkwoolf\LearnOOP\Model
 */
class ConstantsMethods extends AbstractReflection
{
    /** @var int  */
    const NONE = 0;

    /** @var int  */
    const AUTH = 101;

    /**
     * @return \ReflectionMethod[]
     */
    public function getMethods()
    {
        return $this->reflectionClass->getMethods();
    }
}
