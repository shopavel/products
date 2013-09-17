<?php namespace Shopavel\Products;

use InvalidArgumentException;
use Shopavel\Database\Eloquent\Model;

/**
 * Product model.
 *
 * @author Laurence Roberts <lsjroberts@outlook.com>
 */
class Product extends Model implements ProductInterface {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    /**
     * Prices relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices()
    {
        return $this->hasMany('Shopavel\Products\Price');
    }

    /**
     * Get the prices related to the product.
     *
     * @return array
     */
    public function getPrices()
    {
        return $this->prices()->get();
    }

    /**
     * Get a price by type.
     *
     * @param  string $type Type of price.
     * @return Price
     */
    public function getPrice($type)
    {
        foreach ($this->getPrices() as $price)
        {
            if ($price->type == $type)
            {
                return $price;
            }
        }

        throw new InvalidArgumentException(sprintf("No price of type '%s' found.", $type));
    }

}