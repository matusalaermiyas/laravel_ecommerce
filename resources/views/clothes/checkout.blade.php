@extends('layouts.main')

@section('title', 'Checkout')

@section('content')
    @if ($cart)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td>
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['title'] }}"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            {{ $item['title'] }}
                        </td>
                        <td>{{ $item['price'] }} Birr</td>
                        <td>
                            {{ $item['quantity'] }}
                        </td>
                        <td>{{ $item['quantity'] * $item['price'] }}</td>
                        <td>
                            <form method="POST" action="{{route('clothes.remove')}}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $item['id'] }}">
                                <button type="submit" class="btn ">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td>
                        <form action="{{route('clothes.buy')}}" method="POST">
                            @csrf
                            @method('POST')
                            <button class="btn btn-info" type="submit">Order now</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    @else
        <h1>No items in the cart</h1>
    @endif
@endsection
