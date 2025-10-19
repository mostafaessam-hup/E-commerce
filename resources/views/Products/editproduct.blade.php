@extends('Layouts.master')

@section('content')
    <style>
        .flex-row {
            display: flex;
            gap: 10px;

        }

        .flex-row input {
            width: 50%;
        }
    </style>
    <div class="product-section mt-150 mb-150">

        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">تعديل</span> المنتج</h3>
                    </div>
                </div>
            </div>
            <div id="form_status"></div>
            <div class="contact-form">
                <form method="POST" enctype="multipart/form-data" action="{{ url('updateProduct/' . $product->id) }}"
                    onsubmit="return valid_datas( this );">
                    @method('PUT')
                    @csrf
                    @if ($errors->any())
                        <div style="color:red; margin-bottom:15px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p>
                        <input type="text" placeholder={{ $product->name }} name="name" id="name"
                            style="width: 100%" value ="{{ $product->name }}">
                    </p>
                    <p class="flex-row">
                        <input type="number" placeholder="Price" name="price" id="price"
                            value ="{{ $product->price }}">
                        <input type="number" placeholder="Quantity" name="quantity" id="quantity"
                            value ="{{ $product->quantity }}">
                    </p>
                    <p>
                        <textarea placeholder="Description" name="description" id="description"> {{ old('description', $product->description) }}</textarea>
                    </p>
                    <input type="hidden" name="token" value="FsWga4&amp;@f6aw">
                    <p>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)> {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                    </p>
                    <p> <img src="{{ asset($product->image_path) }}" width="200px" height="200px" /> </p>
                    <p>
                        <input type="file" id="image_path" name="image_path">
                    </p>
                    <p><input type="submit" value="Submit"></p>
                </form>
            </div>
        </div>
    </div>
@endsection
