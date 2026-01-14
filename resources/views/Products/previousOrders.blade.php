@extends('Layouts.master')

@section('content')
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            @foreach ($orders as $order)
                                <div class="card single-accordion">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                                style="direction: ltr; text-align: left;">
                                                Order Number {{ $order->id }}
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="billing-address-form">
                                                <form>
                                                    <p><input type="tel" value=" تم انشاء الاوردر بتاريخ    {{ $order->created_at }}" required
                                                            id="phone" name="phone"></p>
                                                    <p><input type="text" value="{{ $order->name }}" required
                                                            id="name" name="name" placeholder="Name"
                                                            _mstplaceholder="43069"
                                                            style="direction: ltr; text-align: start;"></p>
                                                    <p><input type="email" value="{{ $order->email }}" required
                                                            id="email" name="email" placeholder="Email"
                                                            _mstplaceholder="58058"
                                                            style="direction: ltr; text-align: start;"></p>
                                                    <p><input type="text" value="{{ $order->address }}" required
                                                            id="address" name="address" placeholder="Address"
                                                            _mstplaceholder="94653"
                                                            style="direction: ltr; text-align: start;"></p>
                                                    <p><input type="tel" value="{{ $order->phone }}" required
                                                            id="phone" name="phone"></p>
                                                    
                                                </form>

                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12">
                                                        <div class="cart-table-wrap">
                                                            <table class="cart-table">
                                                                <thead class="cart-table-head">
                                                                    <tr class="table-head-row">
                                                                        {{-- <th class="product-remove"></th> --}}
                                                                        <th class="product-image">Product Image</th>
                                                                        <th class="product-name">Name</th>
                                                                        <th class="product-price">Price</th>
                                                                        <th class="product-quantity">Quantity</th>
                                                                        <th class="product-total">Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    @foreach ($order->orderDetails as $orderDetail)
                                                                        <tr class="table-body-row">
                                                                            {{-- <td class="product-remove">
                                                                                <form
                                                                                    action="{{ route('cartProduct.remove', $cartProduct->id) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit">
                                                                                        <i class="far fa-window-close"></i>
                                                                                    </button>
                                                                                </form>
                                                                            </td> --}}
                                                                            <td class="product-image">
                                                                                <img src="{{ asset($orderDetail->product->image_path) }}"
                                                                                    alt="">
                                                                            </td>
                                                                            <td class="product-name">
                                                                                {{ $orderDetail->product->name }}</td>
                                                                            <td class="product-price">
                                                                                {{ $orderDetail->product->price }}</td>
                                                                            <td class="product-quantity">
                                                                                {{ $orderDetail->quantity }}</td>
                                                                            <td class="product-total">
                                                                                ${{ $orderDetail->quantity * $orderDetail->product->price }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4">
                                                        <div class="total-section">
                                                            <table class="total-table">
                                                                <thead class="total-table-head">
                                                                    <tr class="table-total-row">
                                                                        <th>Total</th>
                                                                        <th>Price</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="total-data">
                                                                        <td><strong>Total: </strong></td>
                                                                        <td>
                                                                            {{ $order->orderDetails->sum(function ($orderDetail) {
                                                                                return $orderDetail->product->price * $orderDetail->quantity;
                                                                            }) }}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach




                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
