<?php namespace Shopavel\Products\Transactions;

use Shopavel\Transactions\Transaction;

class StoreProductTransaction extends Transaction {

    public function store(ProductInterface $product)
    {
        if ($this->validate($product))
        {
            $product->save();
        }
    }

}