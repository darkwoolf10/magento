<?php

namespace Darkwoolf\LearnOOP\Model;

/**
 * Class Parameters
 * @package Darkwoolf\LearnOOP\Model
 */
class Parameters
{
    /** @var string  */
    protected $stringParam;

    /** @var object  */
    protected $instanceParam;

    /** @var bool  */
    protected $boolParam;

    /** @var int  */
    protected $intParam;

    /** @var mixed */
    protected $constantParam;

    /** @var mixed */
    protected $optionalParam;

    /** @var array  */
    protected $arrayParam;

    /**
     * Parameters constructor.
     * @param string $stringParam
     * @param object $instanceParam
     * @param bool $boolParam
     * @param int $intParam
     * @param $constantParam
     * @param $optionalParam
     * @param array $arrayParam
     */
    public function __construct(
        string $stringParam,
        $instanceParam,
        bool $boolParam,
        int $intParam,
        $constantParam,
        $optionalParam,
        array $arrayParam
    ) {
        $this->stringParam = $stringParam;
        $this->instanceParam = $instanceParam;
        $this->boolParam = $boolParam;
        $this->intParam = $intParam;
        $this->constantParam = $constantParam;
        $this->optionalParam = $optionalParam;
        $this->arrayParam = $arrayParam;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        $param = [
            'stringParam' => $this->stringParam,
            'instanceParam' => $this->instanceParam,
            'boolParam' => $this->boolParam,
            'intParam' => $this->intParam,
            'constantParam' => $this->constantParam,
            'optionalParam' => $this->optionalParam,
            'arrayParam' => $this->arrayParam,
        ];

        return $param;
    }
}
