# Website Verification

This template will attempt to verify the domain name where service will be rendered.

## Install using composer
```bash
composer require form-synergy/site-verification
```

## Include the library
```php
require '/vendor/autoload.php';
```

##  Enable session management
```PHP
\FormSynergy\Session::enable();
```

## Import the Form Synergy class
```PHP
use \FormSynergy\Fs as FS;
```

You will need to retrieve your credentials in the Form Synergy console.

Console Access: https://formsynergy.com/console/

- $profileid = '';
- $apikey = '';
- $apisecret = '';

If you are a reseller
- $resellerid = '';




## Configuration
```PHP
FS::Config([
    'version' => 'v1',
    'protocol' => 'https',
    'endpoint' => 'api.formsynergy.com',
    'apikey' => $apikey,
    'secretkey' => $secretkey,
     //'resellerid' => $resellerid,  If you are a reseller
    'max_auth_count' => 15,
]);
```

## local storage
Enable local storage to store downloads and responses. 
```PHP
FS::Storage( '/', 'local-storage' );
```

## Load account
Load and start managing an account.
```PHP
$api = FS::Api()->Load($profileid);
```

## Run script
update the empty values with the appropriate information.
```PHP
\FormSynergy\Site_Verification::Run([
    'proto' => '',
    'domain' => '',
    'name' => '',
    'indexpage' => '',
])
```