@extends('layouts.main')

@section('title', 'T-shirts')

@section('content')

    <div class="woah dealWithIt row">
        @foreach ($products as $product)
            <div class="col-sm-3" style="margin-top: 10px">
                <div class="row">
                    <div class="col-sm-12">
                        <div style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; border-radius: 6px; overflow: hidden;">
                            <img src={{ $product->image_url }} alt="{{ $product->title }}" class="img-responsive"
                                style="width: 100%; height: 180px; object-fit: cover">

                            <div>
                                <div style="padding-left: 10px">
                                    <p>{{ $product->title }}</p>
                                    <p>{{ $product->price }} Birr</p>
                                </div>
                                <a href="/clothes/add-to-cart/{{ $product->id }}?type={{ $product->type }}"
                                    class="btn btn-info btn-sm btn-block">
                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                    Add To Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-sm-12">
            {{ $products->links() }}
        </div>
    </div>

@endsection
