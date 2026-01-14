@extends('Layouts.master')

@section('content')
    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
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
                                            <form action="{{ route('cartProduct.remove', $cartProduct->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <i class="far fa-window-close"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="product-image">
                                            <img src="{{ asset($cartProduct->product->image_path) }}" alt="">
                                        </td>
                                        <td class="product-name">{{ $cartProduct->product->name }}</td>
                                        <td class="product-price">{{ $cartProduct->product->price }}</td>
                                        <td class="product-quantity">{{ $cartProduct->quantity }}</td>
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
                        <div class="cart-buttons">
                            <a href="completedOrder" class="boxed-btn black">Check Out</a>
                        </div>
                    </div>
                    <div class="cart-buttons">
                        <a href="previousOrders" class="boxed-btn black">previous orders</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <!-- end cart -->
@endsection
