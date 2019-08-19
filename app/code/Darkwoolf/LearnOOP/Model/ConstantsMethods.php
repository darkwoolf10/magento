<?php

namespace Darkwoolf\LearnOOP\Model;

/**
 * Class ConstantsMethods
 * @package Darkwoolf\LearnOOP\Model
 */
class ConstantsMethods
{
    const NONE = 0;

    const REQUEST = 100;

    const AUTH = 101;

    private $reflectionClass;

    public function __construct()
    {
        $this->reflectionClass = new \ReflectionClass(__CLASS__);
    }

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
     */
    public function getConstants(): array
    {
        return $this->reflectionClass->getConstants();
    }

    /**
     * @return \ReflectionMethod[]
     */
    public function getMethods()
    {
        return $this->reflectionClass->getMethods();
    }
}
