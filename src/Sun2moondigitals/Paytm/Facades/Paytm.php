<?php 

// Define namespace
namespace Sun2moondigitals\Paytm\Facades;

// Include namespace
use Illuminate\Support\Facades\Facade;

/**
 * Paytm - Facade to support integration with Laravel framework 
 *
 * @author     lakshmaji <lakshmajee88@gmail.com>
 * @package    Paytm
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */ 
class Paytm extends Facade {
	protected static function getFacadeAccessor() { 
		return 'paytm'; 
	}
}
// end of class Paytm
// end of file Paytm.php