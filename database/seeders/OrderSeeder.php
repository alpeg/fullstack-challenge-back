<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\PizzaProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $order = Order::create([
                'name' => 'Alexander',
                'tel' => '+74951234567',
                'email' => 'alexander@example.com',
                'addr' => 'the Red Square, Moscow',
                'total' => '543.21',
            ]);
            /** @var Order $order */
            $pps = PizzaProduct::query()->orderBy('order')->limit(2)->get();
            $i = 3;
            foreach ($pps as $pp) {
                $order->pizzaProducts()->attach($pp->id, ['amount' => $i++]);
            }
        });
    }
}
