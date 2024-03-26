<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;

class CartController extends Controller
{

    use ImageTrait;

    public function index()
    {
        $client = auth('client')->user();
        $carts = $client->carts()->get();
        return view('client.pages.cart.index', compact('carts'));
    }


}
