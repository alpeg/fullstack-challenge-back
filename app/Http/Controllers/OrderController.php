<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PizzaProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function history(Request $request)
    {
        $user = Auth::user();
        if (!$user) return ['success' => false, 'error' => 'No auth'];
        return Order::query()->with('pizzaProducts')->where('user_id', '=', $user->id)->orderBy('id', 'desc')->simplePaginate(2);
    }
    public function fill(Request $request)
    {
        $user = Auth::user();
        if (!$user) return ['success' => false, 'error' => 'No auth'];
        $order = Order::query()->where('user_id', '=', $user->id)->orderBy('id', 'desc')->first();
        if (!$order) {
            return ['name' => $user->name, 'email' => $user->email];
            // return ['success' => false, 'error' => 'No orders'];
        }
        return $order;
    }

    public function create(Request $request)
    {
        $validated = $request->validate([ // 422
            'name' => 'required|max:200',
            'email' => 'bail|required|email:rfc|max:200',
            'addr' => 'required|max:200',
            'tel' => 'required|max:200',
        ]);
//        return ['CART' => $request->input('cart')];
//        $request->input("cart.{$i}.id");
//        $request->input("cart.{$i}.amount");

        $reply = null;
        $success = false;
        $user = Auth::user();

        try {
            DB::transaction(function () use ($request, &$reply, &$success, $user) {
                /*
                 * [
                    'name' => 'Alexander',
                    'tel' => '+74951234567',
                    'email' => 'alexander@example.com',
                    'addr' => 'the Red Square, Moscow',
                    'total' => '543.21',
                ]
                 */
                $cart = $request->input('cart');
                $cartl = count($cart);
                $total = 4;
                for ($i = 0; $i < $cartl; $i++) {
                    $id = (int)$request->input("cart.{$i}.id");
                    $amount = (int)$request->input("cart.{$i}.amount");
                    if ($amount <= 0) {
                        $reply = ['success' => false, 'error' => 'amount <= 0; ' . $amount];
                        throw new \Exception();
                    }
                    $pizza = PizzaProduct::query()->where('id', '=', $id)->first();
                    if (!$pizza || $pizza->disabled != PizzaProduct::DISABLED_INSTOCK) {
                        $reply = ['success' => false, 'error' => 'bad pizza with id ' . $id];
                        throw new \Exception();
                    }
                    $total += $amount * $pizza->price;
                }
                $order = Order::create($request->only('name', 'email', 'addr', 'tel') + ['total' => $total]);
                if ($user) $order->user()->associate($user);
                /* @var $order Order */
                for ($i = 0; $i < $cartl; $i++) {
                    $id = (int)$request->input("cart.{$i}.id");
                    $amount = (int)$request->input("cart.{$i}.amount");
                    $order->pizzaProducts()->attach($id, ['amount' => $amount]);
                }
                $order->save();

                $reply = ['success' => true, 'U' => $user];
                $success = true;
            });
        } catch (\Throwable $t) {
            if ($reply) return $reply;
            throw $t;
        }
        if ($reply) return $reply;
        return ['success' => false, 'error' => 'unknown error?'];
    }

    public function spaConfig(Request $request)
    {
        return [
            'currencies' => ['USD', 'EUR',],
            'currencyInfo' => [
                'USD' => ['scale' => 1, 'symbhol' => '$'],
                'EUR' => ['scale' => 1/1.22835, 'symbhol' => '€'],
            ],
            'deliveryCost' => 4,
        ];
    }
}
