<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace YT\CustomerRegisterForm\Model\Data;

use YT\CustomerRegisterForm\Api\Data\CountryInterface;

class Country extends \Magento\Framework\Api\AbstractExtensibleObject implements CountryInterface
{

    /**
     * Get iso2_code
     * @return string|null
     */
    public function getIso2Code()
    {
        return $this->_get(self::ISO2_CODE);
    }

    /**
     * Set iso2_code
     * @param string $iso2Code
     * @return \YT\CustomerRegisterForm\Api\Data\CountryInterface
     */
    public function setIso2Code($iso2Code)
    {
        return $this->setData(self::ISO2_CODE, $iso2Code);
    }

    /**
     * Get iso3_code
     * @return string|null
     */
    public function getIso3Code()
    {
        return $this->_get(self::ISO3_CODE);
    }

    /**
     * Set iso3_code
     * @param string $iso3Code
     * @return \YT\CustomerRegisterForm\Api\Data\CountryInterface
     */
    public function setIso3Code($iso3Code)
    {
        return $this->setData(self::ISO3_CODE, $iso3Code);
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
     * @return \YT\CustomerRegisterForm\Api\Data\CountryInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
}

