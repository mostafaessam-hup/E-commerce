<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {

    // $result = DB::table("categories")->where('id', '>','0')->get();//query builder
    $result = Category::all();
    return view('welcome', ['categories' => $result]);
});

Route::get('/category', function () {
    $categories = Category::all();
    $products = Product::all();

    return view('category', ['products' => $products, 'categories' => $categories]);
});



Route::get('product/{catid?}', function ($catid = null) {
    if ($catid) {
        $result = Product::where('category_id', $catid)->get();
    } else {
        $result = Product::paginate(3);
    }
    return view('product', ['products' => $result]);
});

Route::get('/addProduct', [ProductController::class, 'addProduct'])->middleware('auth');
Route::get('/reviews', [FirstController::class, 'reviews']);
Route::get('/editProduct/{product}', [ProductController::class, 'editProduct'])->middleware('auth');
Route::put('/updateProduct/{product}', [ProductController::class, 'updateProduct'])->middleware('auth');
Route::delete('/product/{product}', [ProductController::class, 'removeProduct'])->name('product.remove')->middleware('auth');
Route::post('/storeProduct', [ProductController::class, 'storeProduct'])->middleware('auth');

Route::get('/productsTable', [ProductController::class, 'productsTable']);

Route::post('/search', [FirstController::class, 'search']);
