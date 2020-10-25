<?php

namespace YT\CustomerRegisterForm\Block;

use Magento\Framework\View\Element\Template;

class CustomerFormBlock extends Template
{
    /**
     * @var \YT\CustomerRegisterForm\Api\LayoutProcessorInterface[]
     */
    protected $layoutProcessors;

    public function __construct(
        Template\Context $context,
        array $layoutProcessors,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->layoutProcessors = $layoutProcessors;
    }


    public function getJsLayout()
    {
        foreach ($this->layoutProcessors as $processor) {
            $this->jsLayout = $processor->process($this->jsLayout);
        }

        return parent::getJsLayout();
    }


}
