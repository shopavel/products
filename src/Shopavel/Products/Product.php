<?php namespace Shopavel\Products;

use Eloquent;

class Product extends Eloquent implements ProductInterface {

    public function price()
    {
        $price = $this->price;

        // ... do some logic based on tax ...

        return $price;
    }

    public function url()
    {

    }

    public function image()
    {

    }

    public function images()
    {

    }

    public function categories()
    {

    }

    public function features()
    {

    }

    public function variations()
    {

    }

}