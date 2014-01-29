<?php

use Illuminate\Support\Str;
use Shopavel\Products\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder {

    public function run()
    {
        Product::unguard();

        $faker = Faker\Factory::create();

        for($i = 0; $i < 100; $i++)
        {
            $name = $faker->words(rand(1, 3));

            $product = Product::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'sku'  => $faker->randomNumber(8),
            ]);

            foreach($this->container['config']->get('shopavel/products::prices.types') as $type)
            {
                $price = Price::create([
                    'name' => $type,
                    'price' => $faker->randomFloat(2, 1.00, 100.00),
                ]);
                $product->prices()->save($price);
            }
        }
    }

}