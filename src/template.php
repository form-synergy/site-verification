<?php
namespace FormSynergy;

/**
 * FormSynergy PHP Api template.
 *
 * This template requires the FormSynergy PHP Api.
 *
 * This script will register and verify the website where interactions will be served.
 * Package repository: https://github.com/form-synergy/website-essentials
 *
 * @author     Joseph G. Chamoun <formsynergy@gmail.com>
 * @copyright  2019 FormSynergy.com
 * @licence    https://github.com/form-synergy/template-essentials/blob/dev-master/LICENSE MIT
 * @package    web-essentials
 */

/**
 * This package requires the FormSynergy PHP API
 * Install via composer: composer require form-synergy/php-api
 */
require_once 'vendor/autoload.php';
 
/**
 * Import the FormSynergy class
 */
use \FormSynergy\Fs as FS;

/**
 *
 * Web Essentials Class 
 *
 * @version 1.0
 */
class Site_Verification
{

    public static function Run($data)
    {
 
        /**
         * Load account, this action requires the profile id
         */
        $api = FS::Api()->Load($data['profileid']);

        /**
         * The domain name in question must be already
         * registered and verified with FormSynergy.
         *
         * For more details regarding domain registration
         * API documentation: https://formsynergy.com/documentation/websites/
         *
         * You can clone the verification package from Github
         * Github repository: https://github.com/form-synergy/domain-verification
         *
         * Alternatively it can be installed via composer
         * composer require form-synergy/domain-verification
         */


        /**
         * Register the website with FormSynergy first.
         */
        $api->Create('website')
            ->Attributes([
                'proto' => $data['proto'],
                'domain' => $data['domain'],
                'name' => $data['name'],
                'indexpage' => $data['indexpage'],
            ])
            ->As('website');
        
        /**
         * Next step is to verify the domain.
         * In order to verify a domain name, 
         * a meta tag must be placed in the head of the website.
         * Example: <meta name="fs:siteid" content="web-..."/>
         * Read more: https://formsynergy.com/documentation/quickstart/#register-and-verify-domain
         */    
        $api->Get('website')
            ->Where([
                'siteid' => $api->_website('siteid')
            ])
            ->Verify()
            ->As('site_verification');
        if( !$api->_site_verification('verified') ) {
            echo '<div style="font-size:2rem; color:tomato; margin: auto; width="500px; padding: 1rem;">Unable to verify site!</div>';
            echo '<div style="font-size:1.3rem; margin: auto; width="500px;">Make sure that the meta tag is placed in the head of the website.</div>';
        }
                            
        /**
         * To store resources and data
         **/
        FS::Store($api->_all());
    }
}


 