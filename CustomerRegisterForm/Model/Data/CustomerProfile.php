<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Model\Data;

use YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface;

class CustomerProfile extends \Magento\Framework\Api\AbstractExtensibleObject implements CustomerProfileInterface
{

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId()
    {
        return $this->_get(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param string $entityId
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    /**
     * Set email
     * @param string $email
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get phone
     * @return string|null
     */
    public function getPhone()
    {
        return $this->_get(self::PHONE);
    }

    /**
     * Set phone
     * @param string $phone
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }

    /**
     * Get address
     * @return string|null
     */
    public function getAddress()
    {
        return $this->_get(self::ADDRESS);
    }

    /**
     * Set address
     * @param string $address
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**
     * Get country_id
     * @return string|null
     */
    public function getCountryCode()
    {
        return $this->_get(self::COUNTRY_CODE);
    }

    /**
     * Set country_id
     * @param string $countryId
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setCountryCode($countryId)
    {
        return $this->setData(self::COUNTRY_CODE, $countryId);
    }
}

