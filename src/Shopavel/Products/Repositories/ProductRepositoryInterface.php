<?php namespace Shopavel\Products\Repositories;

interface ProductRepositoryInterface {

    public function query();
    public function setQuery($query);
    public function all();
    public function newest();
    public function bestselling();
    public function get();

}