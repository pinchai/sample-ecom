@extends('master')
@section('title','Cart — Sample Store')
@section('content')
    <div class="container">
        <div class="row">
            {{-- Cart items --}}
            <div class="col-lg-8 mb-4">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="mb-0">Your Cart</h4>
                    <span class="badge badge-dark ml-2">{{ $cartCount ?? 0 }} items</span>
                </div>

                @if(($user_cart ?? collect())->isEmpty())
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <div class="display-4 mb-2">🧺</div>
                            <h5 class="mb-2">Your cart is empty</h5>
                            <p class="text-secondary mb-4">Let’s find something you’ll love.</p>
                            <a href="/product" class="btn btn-dark rounded-pill">Start shopping</a>
                        </div>
                    </div>
                @else
                    <div class="card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle">
                                <thead class="thead-light">
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center" style="width: 120px;">Price</th>
                                    <th class="text-center" style="width: 140px;">Qty</th>
                                    <th class="text-right" style="width: 120px;">Subtotal</th>
                                    <th style="width: 48px;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- Error messages (like Flask flash) -->
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @foreach($user_cart as $item)
                                    <tr>
                                        <td>
                                            <div class="media align-items-center">
                                                <img class="cart-thumb mr-3"
                                                     src="{{ asset('/').'image/'.$item->image }}"
                                                     alt="{{ $item->name }}">
                                                <div class="media-body">
                                                    <div class="font-weight-600">{{ $item->name }}</div>
                                                    @if(!empty($item->variant))
                                                        <small class="text-muted">{{ $item->variant }}</small>
                                                    @endif
                                                    @if(!empty($item->sku))
                                                        <small class="text-muted d-block">SKU: {{ $item->sku }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            @if(!empty($item->compare_at))
                                                <div><span
                                                        class="line-through mr-1">${{ number_format($item->compare_at,2) }}</span>
                                                </div>
                                            @endif
                                            <div class="text-dark font-weight-bold">
                                                ${{ number_format($item->price,2) }}</div>
                                        </td>

                                        <td class="text-center">
                                            {{-- Update quantity form --}}
                                            <form action="{{ route('cart_update') }}"
                                                  method="post"
                                                  class="d-inline-flex align-items-center justify-content-center">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                                <input type="number" name="qty"
                                                       class="form-control form-control-sm text-center qty-input"
                                                       value="{{ $item->qty }}" min="1">
                                                <button class="btn btn-sm btn-outline-secondary ml-2" type="submit">
                                                    Update
                                                </button>
                                            </form>
                                        </td>

                                        <td class="text-right">${{ number_format($item->price * $item->qty, 2) }}</td>

                                        <td class="text-center">
                                            {{-- Remove item form --}}
                                            <form action="{{ route('cart_remove') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                                <button class="btn btn-sm btn-outline-danger" type="submit"
                                                        aria-label="Remove">×
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Summary --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Summary</h5>

                        {{-- Promo code --}}
                        <form action="#" method="post" class="mb-3">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="code" class="form-control" placeholder="Promo code"
                                       value="{{ old('code') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-dark" type="submit">Apply</button>
                                </div>
                            </div>
                        </form>

                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Subtotal</span>
                                <strong>${{ number_format($subtotal ?? 0, 2) }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Shipping</span>
                                <span>${{ number_format($shipping ?? 0, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tax</span>
                                <span>${{ number_format($tax ?? 0, 2) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="font-weight-bold">Total</span>
                                <span class="font-weight-bold">${{ number_format(($total ?? 0), 2) }}</span>
                            </li>
                        </ul>

                        <a href="/" class="btn btn-outline-dark btn-block mb-2">Continue shopping</a>
                        <a href="{{ route('checkout_index') }}" class="btn btn-dark btn-block"
                           type="submit">Checkout</a>
                    </div>
                </div>

                {{-- Policies --}}
                <div class="card border-0 shadow-sm mt-3">
                    <div class="card-body small text-secondary">
                        <div class="d-flex align-items-start mb-2">
                            <i class="fa-solid fa-rotate-left mr-2 mt-1"></i>
                            <div><strong>Free returns</strong> within 30 days</div>
                        </div>
                        <div class="d-flex align-items-start mb-2">
                            <i class="fa-solid fa-lock mr-2 mt-1"></i>
                            <div><strong>Secure checkout</strong> powered by SSL</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
