<?php

/*
|--------------------------------------------------------------------------
| File which returns array of constants containing the paytm wallet 
| integration credentials. 
|--------------------------------------------------------------------------
|
*/

return array(

    /*
    |--------------------------------------------------------------------------
    | Paytm API Manager key
    |--------------------------------------------------------------------------
    |
    | Specify the key used to identify the vendor
    |
    */

	'key' => '<YOUR_PAYTM_API_KEY>',

    /*
    |--------------------------------------------------------------------------
    | Paytm Registerd Merchant ID
    |--------------------------------------------------------------------------
    |
    | Specify the merchant id used to identify the vendor
    |
    */

	'PAYTM_MERCHANT_MID' => '<YOUR_PAYTM_MERCHANT_ID>',

    /*
    |--------------------------------------------------------------------------
    | Paytm Merchant website
    |--------------------------------------------------------------------------
    |
    | Specify the website that should be authorized with the 
    | given configuration details
    |
    */

	'PAYTM_MERCHANT_WEBSITE' => '<YOUR_PAYTM_MERCHANT_WEBSITE>',

    /*
    |--------------------------------------------------------------------------
    | Paytm Merchant key
    |--------------------------------------------------------------------------
    |
    | Specify the merchant key used to authorize the vendor with 
    | given merchant id
    |
    */

	'PAYTM_MERCHANT_KEY' => '<YOUR_PAYTM_MERCHANT_KEY>',

    /*
    |--------------------------------------------------------------------------
    | Paytm Wallet API integration environment
    | The possible values are TEST and PROD represents "testing"
    | and "production" environments respectively
    |
    | NOTE: Set this value to PROD while moving to production
    |--------------------------------------------------------------------------
    |
    | Specify the key used to identify the vendor
    |
    */

	'PAYTM_ENVIRONMENT' => 'TEST', //PROD
);

// end of file paytm.php