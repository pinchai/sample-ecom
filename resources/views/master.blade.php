<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Sample Store')</title>

    {{-- Bootstrap 4.6 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- Theme --}}
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
<div id="app" class="d-flex flex-column min-vh-100">
    <section class="py-4 hero bg-white border-bottom">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="display-5 mb-3">New arrivals</h1>
                    <p class="lead text-secondary mb-0">Fresh picks curated for you. Simple, stylish, fast.</p>
                </div>
            </div>
        </div>
    </section>
    {{-- Flash messages --}}
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>@endif
    </div>

    <main class="flex-fill">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-auto bg-white border-top">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h6 class="text-uppercase text-muted small">About</h6>
                    <p class="mb-0 text-secondary">We provide quality products with a focus on simplicity and speed.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h6 class="text-uppercase text-muted small">Links</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="/">Home</a></li>
                        <li><a href="/product">Product</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="text-uppercase text-muted small">Contact</h6>
                    <ul class="list-unstyled mb-0 text-secondary">
                        <li>Phone: +855 123 456 789</li>
                        <li>Email: info@fake.com</li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-4 small text-muted">&copy; {{ date('Y') }} Your Company. All rights reserved.
            </div>
        </div>
    </footer>
</div>

{{-- Core JS --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script
    src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<script>
    const {createApp} = Vue;
    createApp({
        delimiters: ['[[', ']]'],
        data() {
            return {
                cart_list: []
            }
        },
        methods: {
            // Swal.fire({
            //     title: "Deleted!",
            //     text: "Your file has been deleted.",
            //     icon: "success"
            // });


            addToCart(product_id) {
                let url = "{{ url('/cart/add-to-cart') }}"
                $.LoadingOverlay("show");
                axios.post(url, {
                    product_id: product_id
                })
                    .then(function (response) {
                        console.log(response);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Product added to cart successfully!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    }).finally(function () {

                    $.LoadingOverlay("hide");
                })
            }
        }
    }).mount('#app');
</script>
</body>
</html>
