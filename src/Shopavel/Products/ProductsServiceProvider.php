<?php namespace Shopavel\Products;

use Illuminate\Support\Collection;
use Shopavel\Products\Transactions;
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
        $app['product.transactions'] = $app->share(function($app)
        {
            $update = new Transactions\UpdateProductTransaction([
                new RequiredPropertiesValidator(['name'])
            ]);

            $store = new Transactions\StoreProductTransaction;

            return new Transactions\Collection([
                'update' => $update,
                'store' => $store
            ]);
        });

        $app->bind(
            'Shopavel\Products\Repositories\ProductRepositoryInterface',
            'Shopavel\Products\Repositories\EloquentProductRepository'
        );

        $app->bind('Shopavel\Products\Transactions\Collection', function($app)
        {
            return $app['product.transactions'];
        });

        /*
        // Register the save validation on the model saving event.
        Product::saving(function($product) use ($app)
        {
            $app['product.transactions.save']->validate($product);
        });
        */
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