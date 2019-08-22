<?php


namespace Darkwoolf\AskQuestion\Ui\Component\MassAction\Visibility;


class ChangeStatus implements \Zend\Stdlib\JsonSerializable
{
    /**
     * @var \Magento\Catalog\Model\Product\VisibilityFactory
     */
    protected $visibilityFactory;
    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var string
     */
    protected $urlPath;

    /**
     * @var string
     */
    protected $paramName;

    /**
     * @var array
     */
    protected $additionalData = [];

    /**
     * @param \Magento\Catalog\Model\Product\VisibilityFactory $visibilityFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $data
     */
    public function __construct(
    \Magento\Catalog\Model\Product\VisibilityFactory $visibilityFactory,
    \Magento\Framework\UrlInterface $urlBuilder,
    array $data = []
    ) {
        $this->data = $data;
        $this->urlBuilder = $urlBuilder;
        $this->visibilityFactory = $visibilityFactory;
}

    /**
     * Get action options
     *
     * @return array
     */
    public function jsonSerialize()
    {
        if ($this->options === null) {
            $options = $this->visibilityFactory->create()->toOptionArray();
            $this->prepareData();
            foreach ($options as $option) {
                $this->options[$option['value']] = [
                    'type' => 'visibility_status' . $option['value'],
                    'label' => $option['label'],
                ];

                if ($this->urlPath && $this->paramName) {
                    $this->options[$option['value']]['url'] = $this->urlBuilder->getUrl(
                        $this->urlPath,
                        [$this->paramName => $option['value']]
                    );
                }

                $this->options[$option['value']] = array_merge_recursive(
                    $this->options[$option['value']],
                    $this->additionalData
                );
            }

            $this->options = array_values($this->options);
        }

        return $this->options;
    }

    /**
     * Prepare addition data for subactions
     *
     * @return void
     */
    protected function prepareData()
    {
        foreach ($this->data as $key => $value) {
            switch ($key) {
                case 'urlPath':
                    $this->urlPath = $value;
                    break;
                case 'paramName':
                    $this->paramName = $value;
                    break;
                default:
                    $this->additionalData[$key] = $value;
                    break;
            }
        }
    }
}