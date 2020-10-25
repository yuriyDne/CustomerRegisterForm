<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CountryRepositoryInterface
{

    /**
     * Save Country
     * @param \YT\CustomerRegisterForm\Api\Data\CountryInterface $country
     * @return \YT\CustomerRegisterForm\Api\Data\CountryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \YT\CustomerRegisterForm\Api\Data\CountryInterface $country
    );

    /**
     * Retrieve Country
     * @param string $countryId
     * @return \YT\CustomerRegisterForm\Api\Data\CountryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($countryId);

    /**
     * Retrieve Country matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \YT\CustomerRegisterForm\Api\Data\CountrySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Country
     * @param \YT\CustomerRegisterForm\Api\Data\CountryInterface $country
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \YT\CustomerRegisterForm\Api\Data\CountryInterface $country
    );

    /**
     * Delete Country by ID
     * @param string $countryId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($countryId);
}

