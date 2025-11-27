@extends('Layouts.master')

@section('content')
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                                            style="direction: ltr; text-align: left;">
                                            Billing Address
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <form action="{{ route('store.order') }}" id="store-order" name="store-order" method="POST">
                                                @csrf
                                                
                                                <p><input type="text" required id="name" name="name"
                                                        placeholder="Name" _mstplaceholder="43069"
                                                        style="direction: ltr; text-align: start;"></p>
                                                <p><input type="email" required id="email" name="email"
                                                        placeholder="Email" _mstplaceholder="58058"
                                                        style="direction: ltr; text-align: start;"></p>
                                                <p><input type="text" required id="address" name="address"
                                                        placeholder="Address" _mstplaceholder="94653"
                                                        style="direction: ltr; text-align: start;"></p>
                                                <p><input type="tel" required id="phone" name="phone"
                                                        placeholder="Phone" _mstplaceholder="59826"
                                                        style="direction: ltr; text-align: start;"></p>
                                                <p>
                                                    <textarea name="bill" id="bill" cols="30" rows="10" placeholder="Say Something"
                                                        _mstplaceholder="204178" style="direction: ltr; text-align: start;"></textarea>
                                                </p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"
                                            style="direction: ltr; text-align: left;">
                                            Card Details
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-details">
                                            <div class="cart-section">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-md-12">
                                                            <div class="cart-table-wrap">
                                                                <table class="cart-table">
                                                                    <thead class="cart-table-head">
                                                                        <tr class="table-head-row">
                                                                            <th class="product-remove"></th>
                                                                            <th class="product-image">Product Image</th>
                                                                            <th class="product-name">Name</th>
                                                                            <th class="product-price">Price</th>
                                                                            <th class="product-quantity">Quantity</th>
                                                                            <th class="product-total">Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        @foreach ($cartProducts as $cartProduct)
                                                                            <tr class="table-body-row">
                                                                                <td class="product-remove">
                                                                                    <form
                                                                                        action="{{ route('cartProduct.remove', $cartProduct->id) }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit">
                                                                                            <i
                                                                                                class="far fa-window-close"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                </td>
                                                                                <td class="product-image">
                                                                                    <img src="{{ asset($cartProduct->product->image_path) }}"
                                                                                        alt="">
                                                                                </td>
                                                                                <td class="product-name">
                                                                                    {{ $cartProduct->product->name }}</td>
                                                                                <td class="product-price">
                                                                                    {{ $cartProduct->product->price }}</td>
                                                                                <td class="product-quantity">
                                                                                    {{ $cartProduct->quantity }}</td>
                                                                                <td class="product-total">
                                                                                    ${{ $cartProduct->quantity * $cartProduct->product->price }}
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
                                                                                {{ $cartProducts->sum(function ($cartProduct) {
                                                                                    return $cartProduct->product->price * $cartProduct->quantity;
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
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-12 cart-buttons">
                    
                        <a class="boxed-btn black"
                            onclick="event.preventDefault();document.getElementById('store-order').submit();">
                            Place Order
                        </a>
                    
                </div>

            </div>
        </div>
    </div>
@endsection
