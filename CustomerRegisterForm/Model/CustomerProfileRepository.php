<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use YT\CustomerRegisterForm\Api\CustomerProfileRepositoryInterface;
use YT\CustomerRegisterForm\Api\Data\CustomerProfileInterfaceFactory;
use YT\CustomerRegisterForm\Api\Data\CustomerProfileSearchResultsInterfaceFactory;
use YT\CustomerRegisterForm\Model\ResourceModel\CustomerProfile as ResourceCustomerProfile;
use YT\CustomerRegisterForm\Model\ResourceModel\CustomerProfile\CollectionFactory as CustomerProfileCollectionFactory;

class CustomerProfileRepository implements CustomerProfileRepositoryInterface
{

    private $collectionProcessor;

    protected $dataObjectProcessor;

    protected $customerProfileCollectionFactory;

    protected $resource;

    protected $extensionAttributesJoinProcessor;

    protected $dataCustomerProfileFactory;

    protected $dataObjectHelper;

    protected $extensibleDataObjectConverter;
    protected $customerProfileFactory;

    protected $searchResultsFactory;

    private $storeManager;


    /**
     * @param ResourceCustomerProfile $resource
     * @param CustomerProfileFactory $customerProfileFactory
     * @param CustomerProfileInterfaceFactory $dataCustomerProfileFactory
     * @param CustomerProfileCollectionFactory $customerProfileCollectionFactory
     * @param CustomerProfileSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceCustomerProfile $resource,
        CustomerProfileFactory $customerProfileFactory,
        CustomerProfileInterfaceFactory $dataCustomerProfileFactory,
        CustomerProfileCollectionFactory $customerProfileCollectionFactory,
        CustomerProfileSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->customerProfileFactory = $customerProfileFactory;
        $this->customerProfileCollectionFactory = $customerProfileCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomerProfileFactory = $dataCustomerProfileFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface $customerProfile
    ) {
        /* if (empty($customerProfile->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $customerProfile->setStoreId($storeId);
        } */
        
        $customerProfileData = $this->extensibleDataObjectConverter->toNestedArray(
            $customerProfile,
            [],
            \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface::class
        );
        
        $customerProfileModel = $this->customerProfileFactory->create()->setData($customerProfileData);
        
        try {
            $this->resource->save($customerProfileModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the customerProfile: %1',
                $exception->getMessage()
            ));
        }
        return $customerProfileModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($customerProfileId)
    {
        $customerProfile = $this->customerProfileFactory->create();
        $this->resource->load($customerProfile, $customerProfileId);
        if (!$customerProfile->getId()) {
            throw new NoSuchEntityException(__('CustomerProfile with id "%1" does not exist.', $customerProfileId));
        }
        return $customerProfile->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->customerProfileCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface $customerProfile
    ) {
        try {
            $customerProfileModel = $this->customerProfileFactory->create();
            $this->resource->load($customerProfileModel, $customerProfile->getCustomerprofileId());
            $this->resource->delete($customerProfileModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the CustomerProfile: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($customerProfileId)
    {
        return $this->delete($this->get($customerProfileId));
    }
}

