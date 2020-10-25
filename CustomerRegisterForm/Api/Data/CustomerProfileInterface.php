<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Api\Data;

interface CustomerProfileInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const NAME = 'name';
    const PHONE = 'phone';
    const ENTITY_ID = 'entity_id';
    const EMAIL = 'email';
    const ADDRESS = 'address';
    const COUNTRY_CODE = 'country_code';

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param string $entityId
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setEntityId($entityId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setName($name);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setEmail($email);

    /**
     * Get phone
     * @return string|null
     */
    public function getPhone();

    /**
     * Set phone
     * @param string $phone
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setPhone($phone);

    /**
     * Get address
     * @return string|null
     */
    public function getAddress();

    /**
     * Set address
     * @param string $address
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setAddress($address);

    /**
     * Get country_id
     * @return string|null
     */
    public function getCountryCode();

    /**
     * Set country_id
     * @param string $countryId
     * @return \YT\CustomerRegisterForm\Api\Data\CustomerProfileInterface
     */
    public function setCountryCode($countryId);
}

