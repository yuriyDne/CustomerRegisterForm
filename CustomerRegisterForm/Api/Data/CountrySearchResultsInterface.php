<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Api\Data;

interface CountrySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Country list.
     * @return \YT\CustomerRegisterForm\Api\Data\CountryInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \YT\CustomerRegisterForm\Api\Data\CountryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

