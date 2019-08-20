<?php

namespace Darkwoolf\AskQuestion\Model\ResourceModel;

/**
 * Class Question
 * @package Darkwoolf\AskQuestion\ResourceModel
 */
class Question extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('darkwoolf_ask_question', 'question_id');
    }
}
