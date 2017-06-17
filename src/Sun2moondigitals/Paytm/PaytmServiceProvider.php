<?php 

// Define namespace
namespace Sun2moondigitals\Paytm;

// Include namespaces
use Illuminate\Support\ServiceProvider;
use View;

/**
 * Paythm - A package integrating paytm wallet 
 * with Laravel 4 framework applications
 *
 * @author     lakshmaji <lakshmajee88@gmail.com>
 * @package    Paytm
 * @version    1.0.2
 * @since      Class available since Release 1.0.0
 */

class PaytmServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('sun2moondigitals/paytm');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['paytm'] = $this->app->share(function($app) {
			return new Paytm;
		});

		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Paytm', 'Sun2moondigitals\Paytm\Facades\Paytm');
		});





		//php artisan config:publish --path="workbench/servebaba/paytm/src/config" servebaba/paytm

		// Get config loader
		$loader = $this->app['config']->getLoader();

		// Get environment name
		$env = $this->app['config']->getEnvironment();

		// Add package namespace with path set, override package if app config exists in the main app directory
		if (file_exists(app_path() .'/config/packages/sun2moondigitals/paytm')) {
			$loader->addNamespace('paytm', app_path() .'/config/packages/sun2moondigitals/paytm');
		} else {
			$loader->addNamespace('paytm',__DIR__.'/../../config');
		}

		// Load package override config file
		$paytm = $loader->load($env,'paytm','paytm');

		// Override value
		$this->app['config']->set('paytm::paytm',$paytm);

		View::addNamespace('paytm', __DIR__.'/../../views');


		// $this->app['config']['services.paytm-wallet'];
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
