<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CustomerProfileRepositoryInterface
{

    /**
     * Save CustomerProfile
     * @param \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface $customerProfile
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface $customerProfile
    );

    /**
     * Retrieve CustomerProfile
     * @param string $customerprofileId
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($customerprofileId);

    /**
     * Retrieve CustomerProfile matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete CustomerProfile
     * @param \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface $customerProfile
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface $customerProfile
    );

    /**
     * Delete CustomerProfile by ID
     * @param string $customerprofileId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($customerprofileId);
}

