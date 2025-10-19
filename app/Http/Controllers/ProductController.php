<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct()
    {
        $allCategories = Category::all();
        return view('Products.addproduct', ['categories' => $allCategories]);
    }

    public function editProduct(Product $product)
    {
        return view(
            'Products.editproduct',
            [
                'categories' => Category::all(),
                'product' => $product
            ]
        );
    }

    public function updateProduct(Product $product, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:100',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:1',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:categories,id',
                'image_path'  => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ],
            [
                'image_path.max' => 'The image must be smaller than 2 MB.',
                'image_path.uploaded' => 'The image failed to upload — maybe it’s larger than 2 MB.',
            ]
        );
        $product->name        = $request->name;
        $product->price       = $request->price;
        $product->quantity    = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image_path')) {
            $path = $request->image_path->move(
                'uploads',
                Str::uuid()->toString() . '-' . $request->image_path->getClientOriginalName()
            );
            $product->image_path = $path;
        }

        $product->save();
        return redirect('product')->with('success', 'Product updated successfully.');
    }

    public function removeProduct(Product $product)
    {
        $product->delete();
        return redirect('product')->with('success', 'Product deleted successfully.');
    }


    public function storeProduct(Request $request)
    {
        $validated = $request->validate(
            [
                'name'        => ['required', 'unique:products,name', 'max:100'],
                'price'       => ['required', 'numeric'],
                'quantity'    => ['required', 'integer'],
                'description' => ['required', 'string'],
                'image_path'  => ['required', 'image', 'mimes:jpeg,png,jpg,gif']
            ],
            [
                'image_path.max' => 'The image must be smaller than 2 MB.',
                'image_path.uploaded' => 'The image failed to upload — maybe it’s larger than 2 MB.',
            ]
        );
        $newProduct = new Product;
        $newProduct->name        = $request->name;
        $newProduct->price       = $request->price;
        $newProduct->quantity    = $request->quantity;
        $newProduct->description = $request->description;
        $newProduct->category_id = $request->category_id;


        $path = $request->image_path->move(
            'uploads',
            Str::uuid()->toString() . '-' . $request->image_path->getClientOriginalName()
        );
        $newProduct->image_path = $path;

        $newProduct->save();

        return redirect('/')->with('success', 'Product added successfully!');
    }
}
