<?php namespace Shopavel\Products\Repositories;

use Illuminate\Database\Capsule\Manager as Capsule;

class CapsuleProductRepository implements ProductRepositoryInterface {

    /**
     * Capsule query builder.
     * 
     * @var Capsule
     */
    protected $capsule;

    /**
     * The query that is being built.
     * 
     * @var [type]
     */
    protected $query;

    /**
     * Create the capsule.
     * 
     * @param Capsule $capsule
     */
    public function __construct(Capsule $capsule)
    {
        $this->capsule = $capsule;
    }

    /**
     * Get a blank query if none set.
     * 
     * @return [type]
     */
    public function query()
    {
        if ($this->query === null)
        {
            $this->query = $this->capsule->table('products');
        }
        
        return $this->query;
    }

    /**
     * Set the query.
     * 
     * @param [type] $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * Set the query to select all products.
     * 
     * @return CapsuleProductRepository
     */
    public function all()
    {
        $this->query();

        return $this;
    }

    /**
     * Order the query by newest date created.
     * 
     * @return CapsuleProductRepository
     */
    public function newest()
    {
        $this->query = $this->query()->orderBy('created_at', 'desc');

        return $this;
    }

    /**
     * Order the query by number of products sold.
     * 
     * @return CapsuleProductRepository
     */
    public function bestselling()
    {
        $this->query = $this->query()->orderBy('sold', 'desc');

        return $this;
    }

    /**
     * Get the results from the query.
     * 
     * @return [type]
     */
    public function get()
    {
        return $this->query()->get();
    }

}