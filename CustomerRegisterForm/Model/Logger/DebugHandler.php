<?php

namespace YT\CustomerRegisterForm\Model\Logger;

use Monolog\Logger;

class DebugHandler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * @var int
     */
    protected $loggerType = Logger::INFO;

    public function isHandling(array $record)
    {
        return $record['level'] <= $this->level;
    }


}
