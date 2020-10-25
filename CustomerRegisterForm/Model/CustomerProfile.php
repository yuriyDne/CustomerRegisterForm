<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Model;

use Magento\Framework\Api\DataObjectHelper;
use YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface;
use YT\CustomerRegisterForm\Api\Data\CustomerProfileInterfaceFactory;

class CustomerProfile extends \Magento\Framework\Model\AbstractModel
{

    protected $customerprofileDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'yt_customerregisterform_customerprofile';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param CustomerProfileInterfaceFactory $customerprofileDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \YT\CustomerRegisterForm\Model\ResourceModel\CustomerProfile $resource
     * @param \YT\CustomerRegisterForm\Model\ResourceModel\CustomerProfile\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        CustomerProfileInterfaceFactory $customerprofileDataFactory,
        DataObjectHelper $dataObjectHelper,
        \YT\CustomerRegisterForm\Model\ResourceModel\CustomerProfile $resource,
        \YT\CustomerRegisterForm\Model\ResourceModel\CustomerProfile\Collection $resourceCollection,
        array $data = []
    ) {
        $this->customerprofileDataFactory = $customerprofileDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve customerprofile model with customerprofile data
     * @return CustomerProfileInterface
     */
    public function getDataModel()
    {
        $customerprofileData = $this->getData();
        
        $customerprofileDataObject = $this->customerprofileDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $customerprofileDataObject,
            $customerprofileData,
            CustomerProfileInterface::class
        );
        
        return $customerprofileDataObject;
    }
}

