<?php namespace Shopavel\Products\Repositories;

use Shopavel\Products\Product;

class EloquentProductRepository implements ProductRepositoryInterface {

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function find($id)
    {
        return $this->product->find($id);
    }

    public function findOrFail($id)
    {
        return $this->product->findOrFail($id);
    }

    public function all()
    {
        return $this->product->all();
    }

}