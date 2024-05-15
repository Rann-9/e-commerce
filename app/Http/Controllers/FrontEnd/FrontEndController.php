<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class FrontEndController extends Controller
{
    public function index()
    {
        $category = Category::select('id', 'name')->latest()->get();
        $product = Product::with('product_galleries')->select('id', 'name', 'slug', 'price')->latest()->get();

        return view('pages.Frontend.index', compact(
            'category',
            'product'
        ));
    }
}
