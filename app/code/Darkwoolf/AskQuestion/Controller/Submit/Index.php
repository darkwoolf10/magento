<?php


namespace Darkwoolf\AskQuestion\Controller\Submit;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;

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
     */
    protected function validation($request)
    {
        if (count($request->getParams()) < 5) {
            throw new LocalizedException(__('This request is not valid and can not be processed.'));
        } elseif (!$request->isXmlHttpRequest()) {
            throw new LocalizedException(__('This request is not xml http request.'));
        }
    }
}