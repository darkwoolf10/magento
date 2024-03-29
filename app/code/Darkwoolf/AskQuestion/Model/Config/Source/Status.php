<?php

namespace Darkwoolf\AskQuestion\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Darkwoolf\AskQuestion\Model\Question;

/**
 * Class Status
 * @package Darkwoolf\AskQuestion\Model\Config\Source
 */
class Status implements OptionSourceInterface
{
    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            [
                'label' => __('Answered'),
                'value' => Question::STATUS_ANSWERED,
            ],
            [
                'label' => __('Pending'),
                'value' => Question::STATUS_PENDING,
            ],
        ];
    }
}
