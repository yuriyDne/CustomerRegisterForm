<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Model\ResourceModel\CustomerProfile;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \YT\CustomerRegisterForm\Model\CustomerProfile::class,
            \YT\CustomerRegisterForm\Model\ResourceModel\CustomerProfile::class
        );
    }
}

