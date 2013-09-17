Customers package for Shopavel
==============================

Installation
------------

Add `"shopavel/products": "1.0.*"` to your `composer.json` and run `composer update`.

This package is required by `shopavel/shop`, you will not normally have to specifically require this package.


Configuration
-------------

In `app/config/app/php`, add the provider:

```php
'providers' => array(
    // ...
    'Shopavel\Products\ProductsServiceProvider',
),
```

And the alias:

```php
'aliases' => array(
    // ...
    'Product' => 'Shopavel\Products\Product',
)
```


Usage
-----

### Product

You can use the `Product` alias to access the product eloquent model, e.g. `Product::find(1)`;

**Prices**

There are several types of price associated with a product.

```php
$product = Product::find(1);

foreach ($product->getPrices() as $price)
{
    echo $price->type . ': ' . $price->price;
}
```

You can access a specific price using:

```php
echo $product->getPrice('retail');
```

License
-------

All Shopavel packages are open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)