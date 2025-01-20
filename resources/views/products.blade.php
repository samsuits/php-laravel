@extends('layouts.default')
@section('title', 'Ecom - Products')
@section('content')
    <main class="container">
        <section>
            <div class="row">
                @foreach ($products as $product)
                    <article class="col-12 col-md-6 col-lg-3">
                        <div class="card p-2 shadow-sm">
                            <img src="{{ $product->image }}" alt="{{ $product->title }}" class="img-fluid">
                            <div>
                                <a href="{{ route('products.details', $product->slug) }}">{{ $product->title }}</a>
                                | <span>&#8377; {{ $product->price }}
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </main>
@endsection
