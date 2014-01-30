<?php namespace Shopavel\Products\Transactions;

use Shopavel\Transactions\Transaction;

class UpdateProductTransaction extends Transaction {

    public function update(ProductInterface $product)
    {
        if ($this->validate($product))
        {
            $product->save();
        }
    }

}