<?php namespace Shopavel\Products;

interface ProductInterface {

    public function price();
    public function url();
    public function image();
    public function images();
    public function categories();
    public function features();
    public function variations();

}