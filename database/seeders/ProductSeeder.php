<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products_list = [
            [
                'name'        =>'Alexa',
                'price'       =>'25',
                'description' =>'A product of Amazon',
                'image_name'  =>'alexa.jpg'
            ],[
                'name'        =>'Google Assistant',
                'price'       =>'29',
                'description' =>'A product of Google',
                'image_name'  =>'google.jpg'
            ],[
                'name'        =>'Siri',
                'price'       =>'28',
                'description' =>'A product of Apple',
                'image_name'  =>'siri.jpg'
            ]
        ];

        foreach($products_list as $product_key => $product_array){
            DB::table('products')->insert([
                'name'  =>$product_array['name'],
                'price' =>$product_array['price'],
                'description'  =>$product_array['description'],
                'image_name'  =>$product_array['image_name'],
            ]);
        }
    }
}
