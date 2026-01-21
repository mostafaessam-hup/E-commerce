
@extends('Layouts.master')

@section('content')
{{Session('user')  }}
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">اقسام</span> الموقع</h3>

                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 text-center">
                        <a href="{{ url('product/'. $category->id) }}">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <img src="{{ url($category->image_path) }}" alt="">
                                </div>
                                <h3>{{ $category->name }}</h3>
                            </div>
                        </a>
                    </div>
                @endforeach



            </div>
        </div>
    </div>
@endsection
