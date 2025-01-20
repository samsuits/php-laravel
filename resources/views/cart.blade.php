@extends('layouts.default')
@section('title', 'Ecom - Cart')
@section('content')
    <main class="container">
        <section>
            <div class="row">
                @foreach ($cartItems as $item)
                    <div class="col-12">
                        <div class="card mb-3" style="max-width: 540px">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $item->image }}" alt="{{ $item->title }}" class="img-fluid rounded-start">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a
                                                href="{{ route('products.details', $item->slug) }}">{{ $item->title }}</a>
                                        </h5>
                                        <p class="card-text">Price: &#8377; {{ $item->price }} | Quantity:
                                            {{ $item->quantity }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div>
                <a href="{{ route('products') }}" class="btn btn-primary">Continue Shopping</a>
                <a href="{{ route('checkout.show') }}" class="btn btn-success">Checkout</a>
            </div>

        </section>
    </main>
@endsection
