<?php

namespace Darkwoolf\LearnOOP\Model;

/**
 * Class AbstractReflection
 * @package Darkwoolf\LearnOOP\Model
 */
abstract class AbstractReflection
{
    /** @var \ReflectionClass  */
    protected $reflectionClass;

    /** @var int  */
    const REQUEST = 100;

    /**
     * AbstractReflection constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $this->reflectionClass = new \ReflectionClass(static::class);
    }

    /**
     * @return array
     */
    public function getConstants(): array
    {
        return $this->reflectionClass->getConstants();
    }
}
