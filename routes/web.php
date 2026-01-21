<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, "mainPage"])->middleware('custom.auth');

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
Route::get('/addProductImages/{product}', [ProductController::class, 'addProductImages'])->name('product.images.add');

Route::get('/cart', [ProductController::class, 'cart'])->middleware('auth');
Route::post('/addProductToCart/{product}', [ProductController::class, 'addProductToCart'])->name('cart.product')->middleware('auth');
Route::delete('/cartProduct/{cart}', [ProductController::class, 'removeCartProduct'])->name('cartProduct.remove');
Route::get('/completedOrder', [ProductController::class, 'completedOrder']);
Route::get('/previousOrders', [ProductController::class, 'previousOrders'])->middleware('auth');
Route::post('/storeOrder', [ProductController::class, 'storeOrder'])->name('store.order');

Route::post('lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
})->name('changeLanguage');

Route::post('/search', [FirstController::class, 'search']);
