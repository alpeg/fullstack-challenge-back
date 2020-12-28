<?php

namespace Database\Seeders;

use App\Models\PizzaProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PizzaProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            PizzaProduct::create(['order' => 1, 'title' => 'Pepperoni', 'picture' => 'pepperoni.jpg', 'description' => 'Double pepperoni, mozzarella, marinara sauce, fresh basil', 'price' => '11.00']);
            PizzaProduct::create(['order' => 7, 'title' => 'Cheese', 'picture' => 'cheese.jpg', 'description' => 'Mozzarella, marinara sauce, fresh basil', 'price' => '9.00']);
            PizzaProduct::create(['order' => 4, 'title' => 'Sausage', 'picture' => 'sausage.jpg', 'description' => 'Double italian sausage, mozzarella, marinara sauce, fresh basil', 'price' => '11.00']);
            PizzaProduct::create(['order' => 5, 'title' => 'Supreme', 'picture' => 'supreme.jpg', 'description' => 'Pepperoni, fresh basil, mozzarella, italian sausage, bacon, mushrooms, red onions, black olives, green peppers, marinara sauce', 'price' => '13.50']);
            PizzaProduct::create(['order' => 6, 'title' => 'The Meats', 'picture' => 'the_meats.jpg', 'description' => 'Pepperoni, ham, italian sausage, mozzarella, bacon, marinara sauce, fresh basil', 'price' => '13.50']);
            PizzaProduct::create(['order' => 8, 'title' => 'Buffalo Chicken', 'picture' => 'buffalo_chicken.jpg', 'description' => 'Grilled chicken, buffalo sauce, mozzarella, cheddar, red onions', 'price' => '13.00']);
            PizzaProduct::create(['order' => 9, 'title' => 'Chicken BBQ', 'picture' => 'chicken_bbq.jpg', 'description' => 'Grilled chicken, bbq sauce, bacon, mozzarella, fresh basil, red onions', 'price' => '13.00']);
            PizzaProduct::create(['order' => 10, 'title' => 'Chicken Club', 'picture' => 'chicken_club.jpg', 'description' => 'Grilled chicken, cherry tomatoes, ricotta, fresh parsley, mozzarella, bacon, red onions', 'price' => '13.00']);
            PizzaProduct::create(['order' => 3, 'title' => 'Hawaiian', 'picture' => 'hawaiian.jpg', 'description' => 'Ham, fresh pineapple, mozzarella, marinara sauce, fresh basil', 'price' => '13.00']);
            PizzaProduct::create(['order' => 2, 'title' => 'Veggie', 'picture' => 'veggie.jpg', 'description' => 'Green peppers, cherry tomatoes, mozzarella, ricotta, mushrooms, black olives, red onions', 'price' => '13.00']);
        });
    }
}
