<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;

class productAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attribute = [
            ['id'=>1, 'product_id'=>12 , 'size'=>'Small', 'price'=>1000,'stock'=>10 , 'sku'=>'SDF121', 'status'=>1],
            ['id'=>2, 'product_id'=>12 , 'size'=>'medium', 'price'=>1200,'stock'=>12 , 'sku'=>'SDF122', 'status'=>1],
            ['id'=>3, 'product_id'=>12 , 'size'=>'large', 'price'=>1300,'stock'=>13 , 'sku'=>'SDF123', 'status'=>1],
        ];

        ProductAttribute::insert($attribute);
    }
}
