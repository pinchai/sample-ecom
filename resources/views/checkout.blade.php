@extends('master')
@section('title','Checkout — Sample Store')
@section('content')
    <div class="container py-4">
        <div class="row">
            {{-- Left: Forms --}}
            <div class="col-8 mb-2">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-3">Checkout</h4>
                        <form action="#" method="post">
                            @csrf
                            {{-- Contact --}}
                            <h6 class="text-uppercase text-muted">Contact</h6>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                           value="{{ old('email', $prefill['email'] ?? '') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                           value="{{ old('phone', $prefill['phone'] ?? '') }}" required>
                                </div>
                            </div>


                            {{-- Shipping address --}}
                            <h6 class="text-uppercase text-muted mt-3">Shipping address</h6>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control"
                                           value="{{ old('first_name', $prefill['first_name'] ?? '') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Last name</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                           value="{{ old('last_name', $prefill['last_name'] ?? '') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address1">Address</label>
                                <input type="text" name="address1" id="address1" class="form-control"
                                       value="{{ old('address1', $prefill['address1'] ?? '') }}" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-4 mb-2">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Coca</td>
                                    <td>12$</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-outline-primary w-100">
                            Place Order
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
