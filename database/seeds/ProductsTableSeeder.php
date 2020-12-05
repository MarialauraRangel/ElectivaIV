<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$articles = [
    		[
    			'id' => '1',
    			'category_id' => '1',
    			'provider_id' => '3', 
    			'slug' => 'articulo-1',
    			'cod' => 'A12345',
    			'name' => 'Martillo',
    			'stock' => '30',
    			'sale_price' => '30',
    			'purchase_price' => '30',
    			'description' => 'Martillo de Goma',
    			'photo' => 'martillo.jpg'
    		],
    		[
    			'id' => 2,
    			'category_id' => '1',
    			'provider_id' => '3', 
    			'slug' => 'articulo-2',
    			'cod' => 'B12345',
    			'name' => 'Clavos',
    			'stock' => '30',
    			'sale_price' => '1',
    			'purchase_price' => '1',
    			'description' => 'Calvos de Madera',
    			'photo' => 'clavos.jpg'
    		],

    	];
    	DB::table('articles_24')->insert($articles);
    }
}
