<?php namespace Shopavel\Products;

use Illuminate\Container\Container;
use Shopavel\Support\ServiceProvider;
use Shopavel\Transactions\Validators\RequiredPropertiesValidator;

/**
 * Products service provider.
 *
 * @author Laurence Roberts <lsjroberts@outlook.com>
 */
class ProductsServiceProvider extends ServiceProvider {

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
        $this->package('shopavel/products');

        include __DIR__.'/../../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        // Share the product save transaction.
        $app['product.save'] = $app->share(function($app)
        {
            return new Transactions\SaveProductTransaction([
                new RequiredPropertiesValidator(['name'])
            ]);
        });

        // Register the save validation on the model saving event.
        Product::saving(function($product) use ($app)
        {
            $app['product.save']->validate($product);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('product.create');
    }

}