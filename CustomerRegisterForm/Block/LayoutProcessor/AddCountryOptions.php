<?php

namespace YT\CustomerRegisterForm\Block\LayoutProcessor;

use YT\CustomerRegisterForm\Api\LayoutProcessorInterface;

class AddCountryOptions implements LayoutProcessorInterface
{
    public function process($jsLayout)
    {
        if (!isset($jsLayout['components']['checkoutProvider']['dictionaries'])) {
            $jsLayout['components']['customerFormProvider']['dictionaries'] = [
                'country_id' => [
                    [
                        'label' => 'test 1',
                        'value' => 'test_1',

                    ],
                    [
                        'label' => 'test 2',
                        'value' => 'test_2',

                    ],
                ],
            ];
            $jsLayout['components']['customerFormProvider']['submit_url'] = '/somenonExistingUrl';

            $jsLayout['components']['customerFormProvider']['error'] = false;
        }

        return $jsLayout;
    }

}
