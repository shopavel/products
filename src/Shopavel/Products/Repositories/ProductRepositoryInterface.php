<?php namespace Shopavel\Products\Repositories;

interface ProductRepositoryInterface {

    public function find($id);
    public function findOrFail($id);
    public function all();

}