@extends('layouts.main')

@section('title', "Add To Cart - " . $product->title)

@section('content')
    <div class="row">
        <div class="col-sm-4">
                <img src="{{$product->image_url}}" alt="{{$product->title}}" style="width: 100%; height: 300px; object-fit: contain">
        </div>

        <div class="col-sm-4">
            <form method="POST" action="{{route('clothes.add')}}">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="image_url" value="{{ $product->image_url }}">
                <input type="hidden" name="title" value="{{ $product->title }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <input type="hidden" name="id" value="{{$product->id}}">

                <h1>{{ $product->title }}</h1>
                <p>{{ $product->price }} Birr</p>
                <p>{{ $product->description }}</p>

                <div class="form-group">
                    <select name="color" class="form-control">
                        <option>Select color</option>
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="grey">Grey</option>
                        <option value="grey">Jeans Color</option>
                    </select>
                </div>

                <div class="form-group">
                    <select name="size" class="form-control">
                        <option>Select a Size</option>
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                        <option value="extra">Extra Large</option>
                    </select>
                </div>

        

                <div class="form-group">
                    <input type="number" name="quantity" placeholder="Quantity" class="form-control" min="1">
                    <br>
                    
                    <button class="btn btn-info" type="submit">
                         <span class="glyphicon glyphicon-shopping-cart"></span>
                        Add To Cart
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection

@if (Session::has('added'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            SoloAlert.alert({
                title: "Item Added Successfully, to cart",
                icon: "success"
            });
        })
    </script>
@endif
