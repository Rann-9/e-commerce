<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $product = Product::all();
        return view('pages.admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::all();
        return view('pages.admin.product.modal-create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        try {
            $data = $request->all();

            $data['slug'] = Str::slug($request->name);

            $product = Product::create($data);

            // dd($product);
            return redirect()->route('admin.product.index')->with('success', 'Product add successfully');

        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Failed to add Product');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::find($id);
        $category = Category::all();

        return view('pages.admin.product.modal-edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        try {
            $product = Product::find($id);
            
            $data = $request->all();

            $data['slug'] = Str::slug($request->name);

            $product->update($data);

            // dd($product);
            return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');

        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Failed to add Product');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            //find category
            $product = Product::find($id);

            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete');
        }
    }
}