<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Model;

use Magento\Framework\Api\DataObjectHelper;
use YT\CustomerRegisterForm\Api\Data\CountryInterface;
use YT\CustomerRegisterForm\Api\Data\CountryInterfaceFactory;

class Country extends \Magento\Framework\Model\AbstractModel
{

    protected $countryDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'yt_customerregisterform_country';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param CountryInterfaceFactory $countryDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \YT\CustomerRegisterForm\Model\ResourceModel\Country $resource
     * @param \YT\CustomerRegisterForm\Model\ResourceModel\Country\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        CountryInterfaceFactory $countryDataFactory,
        DataObjectHelper $dataObjectHelper,
        \YT\CustomerRegisterForm\Model\ResourceModel\Country $resource,
        \YT\CustomerRegisterForm\Model\ResourceModel\Country\Collection $resourceCollection,
        array $data = []
    ) {
        $this->countryDataFactory = $countryDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve country model with country data
     * @return CountryInterface
     */
    public function getDataModel()
    {
        $countryData = $this->getData();
        
        $countryDataObject = $this->countryDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $countryDataObject,
            $countryData,
            CountryInterface::class
        );
        
        return $countryDataObject;
    }
}

