@extends('Layouts.master')

@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">

            <div class="row" dir="rtl">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="active" data-filter="*">All</li>

                            @foreach ($categories as $category)
                                <li data-filter="._{{ $category->id }}">{{ $category->name }}</li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            <div class="row product-lists" style="position: relative; height: 1666.99px;">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 text-center _{{ $product->category_id }} "
                        style="position: absolute; left: 0px; top: 0px;">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="single-product.html"><img src="{{ $product->image_path }}" alt=""></a>
                            </div>
                            <h3>{{ $product->name }}</h3>
                            <p class="product-price"><span>Price:</span> {{ $product->price }}$ </p>
                            <p class="product-price"><span>Quantity:</span> {{ $product->quantity }} </p>
                            <form action="{{ route('product.remove', $product->id) }}" method="POST"
                                style="margin-top:10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                            <p>
                            <a href="/editProduct/{{ $product->id }}" class="btn btn-primary">
                                تعديل
                            </a></p>
                            <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="pagination-wrap">
                        <ul>
                            <li><a href="#">Prev</a></li>
                            <li><a href="#">1</a></li>
                            <li><a class="active" href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
