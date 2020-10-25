<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Api\Data;

interface CountryInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const ISO3_CODE = 'iso3_code';
    const NAME = 'name';
    const ISO2_CODE = 'iso2_code';
    const ENTITY_ID = 'entity_id';

    /**
     * Get iso2_code
     * @return string|null
     */
    public function getIso2Code();

    /**
     * Set iso2_code
     * @param string $iso2Code
     * @return \YT\CustomerRegisterForm\Api\Data\CountryInterface
     */
    public function setIso2Code($iso2Code);

    /**
     * Get iso3_code
     * @return string|null
     */
    public function getIso3Code();

    /**
     * Set iso3_code
     * @param string $iso3Code
     * @return \YT\CustomerRegisterForm\Api\Data\CountryInterface
     */
    public function setIso3Code($iso3Code);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \YT\CustomerRegisterForm\Api\Data\CountryInterface
     */
    public function setName($name);
}

