<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Model\ResourceModel;

class CustomerProfile extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Prefix for resources that will be used in this resource model
     *
     * @var string
     */
    protected $connectionName = 'yt';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('yt_customer_profile', 'entity_id');
    }
}

