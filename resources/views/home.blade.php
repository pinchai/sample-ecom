@extends('master')
@section('title','Home — Sample Store')
@section('content')
    <section class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0">Featured products</h2>
            <a
                href="{{ route('cart_index') }}"
                class="btn btn-sm btn-outline-dark rounded-pill"
            >Cart(1)</a>
        </div>

        <div class="row">
            @forelse($products as $p)
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm product-card">
                        <a href="#" class="text-decoration-none text-reset">
                            <div class="ratio ratio-1x1 bg-light">
                                <center>
                                    <img
                                        src="{{ asset('image').'/'.$p->image }}"
                                        alt="{{ $p->name }}"
                                        class="p-3 img-fit"
                                        style="height: 170px; object-fit: contain"
                                    >
                                </center>
                            </div>
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-1 text-truncate" title="{{ $p->name }}">{{ $p->name }}</h6>
                            <p class="text-muted small mb-2 text-truncate">{{ $p->category->name ?? '—' }}</p>
                            <div class="mt-auto d-flex align-items-center justify-content-between">
                                <div class="h5 mb-0">${{ number_format($p->price, 2) }}</div>
                                <button class="btn btn-sm btn-dark rounded-pill"
                                        @click.prevent="addToCart({{ $p->id }}, '{{ addslashes($p->name) }}', {{ $p->price }})">
                                    <i class="fa-solid fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-secondary mb-0">No products yet.</div>
                </div>
            @endforelse
        </div>

        @if(method_exists($products,'links'))
            <div class="d-flex justify-content-center">
                {{ $products->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    </section>
@endsection
