<?php

namespace Darkwoolf\AskQuestion\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Question
 * @package Darkwoolf\AskQuestion\ResourceModel
 */
class Question extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('darkwoolf_ask_question', 'question_id');
    }
}
