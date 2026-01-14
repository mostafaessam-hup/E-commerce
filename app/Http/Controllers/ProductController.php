<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetails;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function productsTable()
    {
        $products = Product::all();
        return view('Products.productsTable', ['products' => $products]);
    }

    public function addProductImages(Product $product)
    {
        return view('Products.addProductImages', ['product', $product]);
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
        return redirect($request->previous_url ?? 'product')->with('success', 'Product updated successfully.');
    }

    public function removeProduct(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }

    public function removeCartProduct(Cart $cart)
    {
        $cart->delete();
        return redirect('/cart')->with('success', 'Product deleted successfully from the cart .');
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

    public function cart()
    {
        $user_id = Auth::user()->id;
        $cartProducts = Cart::Where('user_id', $user_id)
            ->with('product')
            ->get();
        return view('Products.cart', ['cartProducts' => $cartProducts]);
    }


    public function completedOrder()
    {
        $user_id = Auth::user()->id;
        $cartProducts = Cart::Where('user_id', $user_id)
            ->with('product')
            ->get();
        return view('Products.completedOrder', ['cartProducts' => $cartProducts])->with('success','done');  
        
    }

    public function previousOrders()
    {
        $user_id = Auth::user()->id;
        $orders = Order::where('user_id',$user_id)->with('orderDetails')->get();
        

        return view('Products.previousOrders', ['orders'=>$orders]);
        
    }

    public function storeOrder(Request $request)
    {
        $user_id = Auth::user()->id;

        $newOrder = new Order();
        $newOrder->name = $request->name;
        $newOrder->email = $request->email;
        $newOrder->phone = $request->phone;
        $newOrder->address = $request->address;
        $newOrder->user_id = $user_id;
        $newOrder->save();

        $cartProducts = Cart::Where('user_id', $user_id)
            ->with('product')
            ->get();
        foreach ($cartProducts as $item) {
            $newOrderDetail = new OrderDetails();
            $newOrderDetail->product_id = $item->product_id;
            $newOrderDetail->order_id = $newOrder->id;
            $newOrderDetail->quantity = $item->quantity;
            $newOrderDetail->price = $item->product->price;
            $newOrderDetail->save();
        }
        Cart::Where('user_id', $user_id)->delete();
        return view('Products.completedOrder', ['cartProducts' => $cartProducts])->with('success', 'doneeee');
    }

    public function addProductToCart(Product $product)
    {
        $user_id = Auth::user()->id;
        $result = Cart::Where('user_id', $user_id)->where('product_id', $product->id)->first();

        if ($result) {
            $result->quantity += 1;
            $result->save();
        } else {
            $newCart = new Cart();
            $newCart->product_id = $product->id;
            $newCart->user_id = $user_id;
            $newCart->quantity = 1;
            $newCart->save();
        }

        return redirect('/cart');
    }
}
