<?php

namespace YT\CustomerRegisterForm\Model\Logger;

use Monolog\Logger;

class ErrorHandler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * @var int
     */
    protected $loggerType = Logger::ERROR;
}
