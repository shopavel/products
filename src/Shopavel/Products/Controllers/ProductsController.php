<?php namespace Shopavel\Products\Controllers;

use Shopavel\Products\Forms;
use Shopavel\Products\Product;
use Shopavel\Themes\ThemeManager;
use Shopavel\Products\Transactions;
use Shopavel\Products\ProductPresenter;
use Shopavel\Controllers\BaseController;
use Shopavel\Products\Repositories\ProductRepositoryInterface;

class ProductsController extends BaseController {

    protected $theme;
    protected $product;
    protected $presenter;

    public function __construct(
        ThemeManager $theme,
        ProductRepositoryInterface $product,
        ProductPresenter $presenter,
        Transactions\Collection $transactions
    )
    {
        $this->theme = $theme;
        $this->product = $product;
        $this->presenter = $presenter;
        $this->transactions = $transactions;

        // $this->beforeFilter('shopavel.auth.admin', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->product->all();

        return $this->theme->make('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return $this->theme->make('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $product = new Product;

        if ($this->transactions->store($product))
        {
            return \Redirect::route('product.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = $this->product->findOrFail($id);
        $this->presenter->setResource($product);

        return $this->theme->make('product.show')
            ->withProduct($this->presenter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return $this->theme->make('product.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $product = $this->product->findOrFail($id);

        $this->transactions->update($product);

        return \Redirect::route('shopavel.product.edit', ['product' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);

        $this->transactions->delete($product);

        return \Redirect::route('shopavel.product.index');
    }

}