<?php

namespace YT\CustomerRegisterForm\Model\Source;

use Magento\Framework\Api\SearchCriteriaBuilder;
use YT\CustomerRegisterForm\Model\CountryRepository;
use YT\CustomerRegisterForm\Service\ImportCountryService;

class CountyOptions implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var ImportCountryService
     */
    protected $importCountryService;
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    /**
     * @var CountryRepository
     */
    protected $countryRepository;

    /**
     * @var array
     */
    protected $options;

    /**
     * CountyOptions constructor.
     *
     * @param ImportCountryService $importCountryService
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CountryRepository $countryRepository
     */
    public function __construct(
        ImportCountryService $importCountryService,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CountryRepository $countryRepository
    ) {
        $this->importCountryService = $importCountryService;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->countryRepository = $countryRepository;
    }

    public function toOptionArray()
    {
        if (!$this->options) {
            $this->options =  [
                [
                    'value' =>  '',
                    'label' => __('Country'),
                ]
            ];
            $countriesOptions = $this->getCountriesOptions();
            $this->options = array_merge($this->options, $countriesOptions);
        }

        return $this->options;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function getCountriesOptions()
    {
        $countries = $this->getInternalCountries();
        if (!count($countries)) {
            $this->importCountriesFromExternalSource();
        }
        $countries = $this->getInternalCountries();

        $result = [];
        foreach ($countries as $country) {
            $result[] = [
                'value' => $country->getIso2Code(),
                'label' => __($country->getName())->render()
            ];
        }

        return $result;
    }

    /**
     * @return \YT\CustomerRegisterForm\Api\Data\CountryInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function getInternalCountries()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->countryRepository->getList($searchCriteria)->getItems();
    }

    protected function importCountriesFromExternalSource()
    {
        return $this->importCountryService->execute();
    }

}
