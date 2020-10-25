<?php

namespace YT\CustomerRegisterForm\Block\Form;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

/**
 * Class SaveButton
 * @package Magento\Customer\Block\Adminhtml\Edit
 */
class SaveButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Submit'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'customer_register_form.customer_register_form',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [

                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'url' => null,
            'before_html' => "<div class='field right'>",
            'after_html' => "</div>",
            'class_name' => Container::DEFAULT_CONTROL,
        ];
    }

}
