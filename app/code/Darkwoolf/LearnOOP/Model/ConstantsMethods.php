<?php

namespace Darkwoolf\LearnOOP\Model;

use ReflectionMethod;

/**
 * Class ConstantsMethods
 * @package Darkwoolf\LearnOOP\Model
 */
class ConstantsMethods
{
    const NONE = 0;
    const REQUEST = 100;
    const AUTH = 101;

    /**
     * @return int
     */
    public function firstMethod(): int
    {
        return 5;
    }

    /**
     * @return string
     */
    final function secondMethod(): string
    {
        return 'second';
    }

    /**
     * @return bool
     */
    private static function thirdMethod(): bool
    {
        return true;
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function getConstants(): array
    {
        $oClass = new \ReflectionClass(__CLASS__);

        return $oClass->getConstants();
    }

    /**
     * @return \ReflectionMethod[]
     * @throws \ReflectionException
     */
    public function getMethods()
    {
        $class = new \ReflectionClass(__CLASS__);

        return $class->getMethods();
    }
}