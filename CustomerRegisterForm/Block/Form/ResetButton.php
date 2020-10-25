<?php

namespace YT\CustomerRegisterForm\Block\Form;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

/**
 * Class SaveButton
 * @package Magento\Customer\Block\Adminhtml\Edit
 */
class ResetButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Clear'),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'customer_register_form.customer_register_form',
                                'actionName' => 'reset',
                            ]
                        ]
                    ],
                ]
            ],
            'before_html' => "<div class='field left'>",
            'after_html' => "</div>",

            'url' => null,
            'class_name' => Container::DEFAULT_CONTROL,
        ];
    }

}
