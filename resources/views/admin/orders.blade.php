@extends('layouts.main')

@section('title', 'Customer Orders')

@section('content')

@if(count($orders) > 0)
<table class="table">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Size</th>
            <th>Price</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{$order->item_name}}</td>
            <td>{{$order->quantity}}</td>
            <td>{{$order->size}}</td>
            <td>{{$order->price}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else 
<h1>No orders found may be they are deleted</h1>
@endif

@endsection