<?php

namespace App\Http\Controllers;

use App\Models\PizzaProduct;
use Illuminate\Http\Request;

class PizzaProductController extends Controller
{
    public function all(Request $request)
    {
        return PizzaProduct::query()
            ->where('disabled', '<>', PizzaProduct::DISABLED_HIDDEN)
            ->orderBy('order')
            ->get();
    }
}
