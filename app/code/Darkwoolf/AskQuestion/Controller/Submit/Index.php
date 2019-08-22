<?php


namespace Darkwoolf\AskQuestion\Controller\Submit;

use Darkwoolf\AskQuestion\Model\Question;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;

class Index extends \Magento\Framework\App\Action\Action
{


    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    private $formKeyValidator;

    /**
     * @var \Darkwoolf\AskQuestion\Model\QuestionFactory
     */
    private $questionFactory;

    /**
     * Index constructor.
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \Darkwoolf\AskQuestion\Model\QuestionFactory $questionFactory
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Darkwoolf\AskQuestion\Model\QuestionFactory $questionFactory,
        \Magento\Framework\App\Action\Context $context
    ) {
        parent::__construct($context);
        $this->formKeyValidator = $formKeyValidator;
        $this->questionFactory = $questionFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
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
         * @var \Magento\Framework\Controller\Result\Json $controllerResult
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
