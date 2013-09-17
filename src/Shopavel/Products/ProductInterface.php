<?php namespace Shopavel\Products;

/**
 * Product model interface.
 *
 * @author Laurence Roberts <lsjroberts@outlook.com>
 */
interface ProductInterface {

    public function getPrices();
    public function getPrice($type);

}