@extends('layouts.default')
@section('title', 'Ecom - Products')
@section('content')
    <main class="container">
        <section>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-12 col-md-6 col-lg-4 mt-10" >
                        <img src="{{ $product->image }}" alt="" style="width:150px">
                        <p>{{ $product->title }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
