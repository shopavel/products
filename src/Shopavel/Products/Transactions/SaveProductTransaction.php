<?php namespace Shopavel\Products\Transactions;

use Shopavel\Transactions\Transaction;

class SaveProductTransaction extends Transaction {

    public function save(ProdutInterface $product)
    {
        if ($this->validate($product))
        {
            $product->save();
        }
    }

}