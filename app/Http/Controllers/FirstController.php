<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class FirstController extends Controller
{
    public function reviews()
    {
        return view(
            'reviews',
            [
                'reviews' => Review::All()
            ]
        );
    }

    public function search(Request $request)
    {
        $products = Product::where('name','like','%'. $request->searchKey.'%')->get();
        return view('product', ['products' => $products]);
    }
}
