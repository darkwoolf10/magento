<?php


namespace Darkwoolf\AskQuestion\Controller\Submit;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Zend_Validate;

class Index extends \Magento\Framework\App\Action\Action
{
    const STATUS_ERROR = 'Error';
    const STATUS_SUCCESS = 'Success';

    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    private $formKeyValidator;

    /**
     * Index constructor.
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Framework\App\Action\Context $context
    ) {
        parent::__construct($context);
        $this->formKeyValidator = $formKeyValidator;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     * @throws \Zend_Validate_Exception
     */
    public function execute()
    {
        /** @var Http $request */
        $request = $this->getRequest();

        try {
            $this->validation($request);

            $data = [
                'status' => self::STATUS_SUCCESS,
                'message' => $request->getParams()
            ];
        } catch (LocalizedException $e) {
            $data = [
                'status'  => self::STATUS_ERROR,
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
     * @throws \Zend_Validate_Exception
     */
    protected function validation($request)
    {
        if (!Zend_Validate::is($request->getParam('name'), 'NotEmpty')) {
            throw new LocalizedException(__('Your name is empty.'));
        } elseif (!Zend_Validate::is($request->getParam('email'), 'NotEmpty')) {
            throw new LocalizedException(__('Your email is empty.'));
        } elseif (!Zend_Validate::is($request->getParam('phone'), 'NotEmpty')) {
            throw new LocalizedException(__('Your email is empty.'));
        } elseif (!Zend_Validate::is($request->getParam('phone'), 'NotEmpty')) {
            throw new LocalizedException(__('Your email is empty.'));
        } elseif (!Zend_Validate::is($request->getParam('question'), 'NotEmpty')) {
            throw new LocalizedException(__('Your question is empty.'));
        } elseif (!$request->isXmlHttpRequest()) {
            throw new LocalizedException(__('This request is not valid and can not be processed.'));
        } elseif (!$this->formKeyValidator->validate($request) || $request->getParam('isHere')) {
            throw new LocalizedException(__('Something went wrong.
                 Probably you were away for quite a long time already. Please, reload the page and try again.'));
        }
    }
}