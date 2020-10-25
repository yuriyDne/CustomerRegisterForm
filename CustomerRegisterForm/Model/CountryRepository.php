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
use YT\CustomerRegisterForm\Api\CountryRepositoryInterface;
use YT\CustomerRegisterForm\Api\Data\CountryInterfaceFactory;
use YT\CustomerRegisterForm\Api\Data\CountrySearchResultsInterfaceFactory;
use YT\CustomerRegisterForm\Model\ResourceModel\Country as ResourceCountry;
use YT\CustomerRegisterForm\Model\ResourceModel\Country\CollectionFactory as CountryCollectionFactory;

class CountryRepository implements CountryRepositoryInterface
{

    protected $countryCollectionFactory;

    protected $countryFactory;

    private $collectionProcessor;

    protected $dataObjectProcessor;

    protected $dataCountryFactory;

    protected $resource;

    protected $extensionAttributesJoinProcessor;

    protected $dataObjectHelper;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    private $storeManager;


    /**
     * @param ResourceCountry $resource
     * @param CountryFactory $countryFactory
     * @param CountryInterfaceFactory $dataCountryFactory
     * @param CountryCollectionFactory $countryCollectionFactory
     * @param CountrySearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceCountry $resource,
        CountryFactory $countryFactory,
        CountryInterfaceFactory $dataCountryFactory,
        CountryCollectionFactory $countryCollectionFactory,
        CountrySearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->countryFactory = $countryFactory;
        $this->countryCollectionFactory = $countryCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCountryFactory = $dataCountryFactory;
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
        \YT\CustomerRegisterForm\Api\Data\CountryInterface $country
    ) {

        $countryData = $this->extensibleDataObjectConverter->toNestedArray(
            $country,
            [],
            \YT\CustomerRegisterForm\Api\Data\CountryInterface::class
        );

        $countryModel = $this->countryFactory->create()->setData($countryData);

        try {
            $this->resource->save($countryModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the country: %1',
                $exception->getMessage()
            ));
        }
        return $countryModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($countryId)
    {
        $country = $this->countryFactory->create();
        $this->resource->load($country, $countryId);
        if (!$country->getId()) {
            throw new NoSuchEntityException(__('Country with id "%1" does not exist.', $countryId));
        }
        return $country->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->countryCollectionFactory->create();

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
        \YT\CustomerRegisterForm\Api\Data\CountryInterface $country
    ) {
        try {
            $countryModel = $this->countryFactory->create();
            $this->resource->load($countryModel, $country->getCountryId());
            $this->resource->delete($countryModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Country: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($countryId)
    {
        return $this->delete($this->get($countryId));
    }
}

