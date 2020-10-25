<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Api\Data;

interface CustomerProfileSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get CustomerProfile list.
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

