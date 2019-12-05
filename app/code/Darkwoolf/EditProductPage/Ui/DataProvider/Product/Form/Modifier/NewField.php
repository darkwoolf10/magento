<?php

namespace Darkwoolf\EditProductPage\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\Textarea;
use Magento\Ui\Component\Form\Element\DataType\Text;

/**
 * Class NewField
 * @package Darkwoolf\EditProductPage\Ui\DataProvider\Product\Form\Modifier
 */
class NewField extends AbstractModifier
{
    /** @var LocatorInterface  */
    private $locator;

    /**
     * NewField constructor.
     * @param LocatorInterface $locator
     */
    public function __construct(LocatorInterface $locator) {
        $this->locator = $locator;
    }

    /**
     * @param array $data
     * @return array
     */
    public function modifyData(array $data): array
    {
        return $data;
    }

    /**
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive(
            $meta,
            [
                'custom_fieldset' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Custom Fieldset'),
                                'componentType' => Fieldset::NAME,
                                'dataScope' => 'data.product.custom_fieldset',
                                'collapsible' => true,
                                'sortOrder' => 5,
                            ],
                        ],
                    ],
                    'children' => [
                        'custom_title' => $this->getCustomField(),
                        'custom_select' => $this->getCustomSelect(),
                        'custom_content' => $this->getCustomContent(),
                    ],
                ],
            ]
        );

        return $meta;
    }

    /**
     * @return array
     */
    protected function getCustomField(): array
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Custom Title'),
                        'componentType' => Field::NAME,
                        'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,
                        'dataType' => Text::NAME,
                        'sortOrder' => 20,
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getCustomSelect(): array
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Custom select'),
                        'componentType' => Field::NAME,
                        'formElement' => Select::NAME,
                        'dataType' => Text::NAME,
                        'sortOrder' => 10,
                        'options' => [
                            ['value' => '0', 'label' => __('No')],
                            ['value' => '1', 'label' => __('Yes')]
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getCustomContent(): array
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Custom content'),
                        'componentType' => Field::NAME,
                        'formElement' =>Textarea::NAME,
                        'dataType' => Text::NAME,
                        'sortOrder' => 10,
                    ],
                ],
            ],
        ];
    }
}
