<?php

namespace Darkwoolf\AskQuestion\Controller\Submit;

use Darkwoolf\AskQuestion\Model\Question;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Data\Form\FormKey\Validator;
use Darkwoolf\AskQuestion\Model\QuestionFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Index
 * @package Darkwoolf\AskQuestion\Controller\Submit
 */
class Index extends Action
{
    /**
     * @var Validator
     */
    private $formKeyValidator;

    /**
     * @var QuestionFactory
     */
    private $questionFactory;

    /**
     * Index constructor.
     * @param Validator $formKeyValidator
     * @param QuestionFactory $questionFactory
     * @param Context $context
     */
    public function __construct(
        Validator $formKeyValidator,
        QuestionFactory $questionFactory,
        Context $context
    ) {
        parent::__construct($context);
        $this->formKeyValidator = $formKeyValidator;
        $this->questionFactory = $questionFactory;
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        /** @var Http $request */
        $request = $this->getRequest();

        /** @var $question */
        $question = $this->questionFactory->create();

        try {
            $this->validation($request);

            $question->setName($request->getParam('name'))
                ->setEmail($request->getParam('email'))
                ->setPhone($request->getParam('phone'))
                ->setQuestion($request->getParam('question'))
                ->setSku($request->getParam('sku'));
            $question->save();

            $data = [
                'status' => Question::STATUS_SUCCESS,
                'message' => $request->getParams()
            ];
        } catch (LocalizedException $e) {
            $data = [
                    'status'  => Question::STATUS_ERROR,
                'message' => $e->getMessage()
            ];
        }

        /**
         * @var Json $controllerResult
         */
        $controllerResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        return $controllerResult->setData($data);
    }

    /**
     * @param $request
     * @throws LocalizedException
     */
    protected function validation($request)
    {
        if (count($request->getParams()) < 6) {
            throw new LocalizedException(__('This request is not valid and can not be processed.'));
        } elseif (!$request->isXmlHttpRequest()) {
            throw new LocalizedException(__('This request is not xml http request.'));
        }
    }
}
