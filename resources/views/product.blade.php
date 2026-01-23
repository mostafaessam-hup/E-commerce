@extends('Layouts.master')

@section('content')
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">منتجات</span> الموقع</h3>

                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item" style="width: 300px; height: 420px; margin: auto;">
                            <a href="{{ url('product/' . $product->id) }}">
                                <div class="single-product-item">
                                    <div class="product-image">
                                        <img src="{{ url($product->image_path) }}" alt="">
                                    </div>

                                    {{-- 
                                        if i have name_ar, name_en columns  (multi languages)  
                                    @php
                                        $lang = Session::get('locale');
                                    @endphp 
                                        <h3>{{ $product->{'name_'.$lang} }}</h3> 
                                        if i don't, i have to use if condition
                                        --}}
                                    <h3>{{ session('locale') == 'ar' ? $product->name_ar : $product->name }}</h3>

                                    <p class="product-price"><span>Price:</span> {{ $product->price }}$ </p>
                            </a>


                            <div class="mb-1">
                                <form action="{{ route('cart.product', $product->id) }}" method="post" class="m-0">
                                    @csrf
                                    <button type="submit" style="height: 40px;">
                                        <i class="fas fa-shopping-cart"></i> add to cart
                                    </button>

                                </form>
                            </div>

                            <div class="d-flex justify-content-center gap-2 align-items-center">
                                <form action="{{ route('product.remove', $product->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="height: 40px;">
                                        <i class="fas fa-trash"></i> Delete>
                                    </button>
                                </form>

                                <a href="/editProduct/{{ $product->id }}"
                                    class="btn btn-primary d-flex align-items-center justify-content-center"
                                    style="height: 40px;">

                                    تعديل
                                </a>
                            </div>

                        </div>
                    </div>
            </div>
            @endforeach

            <div class="d-flex justify-content-center mt-4 w-100"> {{ $products->links() }}</div>

        </div>
    </div>
    </div>
@endsection
