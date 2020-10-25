# Mage2 Module YT CustomerRegisterForm
For Magento 2.4.1

## Installation
To have a possibility to configure separate database as resource and apply db_schema instructions you need:
- Apply composer patch `CustomerRegisterForm/patches/composer/magento/framework/add_yt_ressource.patch`
- Add a new resource with a separate db credentials in env.php file. For Example
```
    'yt' => [
        'host' => 'localhost',
        'dbname' => 'yt_customer_register',
        'username' => 'root',
        'password' => '',
        'model' => 'mysql4',
        'engine' => 'innodb',
        'initStatements' => 'SET NAMES utf8;',
        'active' => '1',
        'driver_options' => [
            1014 => false
        ]
    ]
```

