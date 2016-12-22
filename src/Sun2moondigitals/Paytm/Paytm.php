<?php 

// Define namespace
namespace Sun2moondigitals\Paytm;

// Include namespace
use Config;
use View;
require_once("lib/encdec_paytm.php");


/**
 * Paythm - A package integrating paytm wallet 
 * with Laravel 4 framework applications
 *
 * @author     lakshmaji <lakshmajee88@gmail.com>
 * @package    Paytm
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */
class Paytm {


	/**
     * Redirect to PayTm wallet authetication page
     *
     * Authorizes the user to pay the amount through PayTm wallet
     * This method will fetchs the configuration details from 
     * config.php file
     * 
     * @access     public
     * @param      $env     defines the type of environment to be used (TEST or PROD) 
     * @param      $type    defines the type of resourec URI to be requested
     * @return     string
     * @version    1.0.0
     * @author     lakshmajim <lakshmajee88@gmail.com>
     * @since      Method available since Release 1.0.0
     */
	public static function goToWallet() {
		// Fetch the configuration details from config file
		$PAYTM_MERCHANT_MID     = Config::get('paytm::paytm.PAYTM_MERCHANT_MID');
		$PAYTM_MERCHANT_WEBSITE = Config::get('paytm::paytm.PAYTM_MERCHANT_WEBSITE'); 
		$PAYTM_MERCHANT_KEY     = Config::get('paytm::paytm.PAYTM_MERCHANT_KEY');
		$PAYTM_ENVIRONMENT      = Config::get('paytm::paytm.PAYTM_ENVIRONMENT');

		// Request type of URI based on the requirement
		// following are the available resources
		// TXN, REFUND, STATUS
		$url = self::getServiceUrl($PAYTM_ENVIRONMENT, 'TXN');

		// Basic order information
		$checkSum         = "";
		$paramList        = array();
		$ORDER_ID         = "orderid123456";
		$CUST_ID          = "customerid123456";
		$INDUSTRY_TYPE_ID = "Retail";
		$CHANNEL_ID       = "WEB";
		$TXN_AMOUNT       = 2;

		// Create an array having all required parameters for creating checksum.
		$paramList["MID"]              = $PAYTM_MERCHANT_MID;
		$paramList["ORDER_ID"]         = "ITSME" . rand(10000,99999999);
		$paramList["CUST_ID"]          = $CUST_ID;
		$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
		$paramList["CHANNEL_ID"]       = $CHANNEL_ID;
		$paramList["TXN_AMOUNT"]       = $TXN_AMOUNT;
		$paramList["WEBSITE"]          = $PAYTM_MERCHANT_WEBSITE;

		// Compute checksum
		$checkSum = getChecksumFromArray($paramList,$PAYTM_MERCHANT_KEY);
		return View::make('paytm::test.paytm',compact(['checkSum','url', 'paramList']));
	}

	// ------------------------------------------------------------------------


	/**
     * Returns the paytm service url
     *
     * Returns the url for requesting paytm to process payments
     * using either test or production mode
     * 
     * @access     public
     * @param      $env     defines the type of environment to be used (TEST or PROD) 
     * @param      $type    defines the type of resourec URI to be requested
     * @return     string
     * @version    1.0.0
     * @author     lakshmajim <lakshmajee88@gmail.com>
     * @since      Method available since Release 1.0.0
     */
	public static function getServiceUrl($env, $type)
	{
		$PAYTM_DOMAIN = ($env === 'PROD') ? 'secure.paytm.in':'pguat.paytm.com';
		if ($type === 'REFUND')
			return 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/REFUND';
		if ($type === 'STATUS')
			return 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/TXNSTATUS';
		if ($type === 'TXN')
			return 'https://'.$PAYTM_DOMAIN.'/oltp-web/processTransaction';
	}

	// ------------------------------------------------------------------------
}
// end of class Paytm
// end of file Paytm.php