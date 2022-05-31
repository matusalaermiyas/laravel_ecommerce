@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>
    <p style="font-style: italic">Orders you ordered, this orders are available if your order after login</p>

    @foreach ($orders as $order)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Order: @if ($order['delivered'] > 0)
                        {{ 'Delivered' }}
                    @else
                        {{ 'Not Delivered' }}
                    @endif
                </h3>
            </div>

            <div class="panel-body">
                @foreach ($order['orders'] as $o)
                    <ul>
                        <li>Item Name: <b>{{ $o->item_name }}</b> </li>
                        <li>Item Price: <b>{{ $o->price }}</b></li>
                        <li>Item Quantity: <b>{{ $o->quantity }}</b></li>
                    </ul>
                    <hr>
                @endforeach
            </div>
        </div>
    @endforeach




@endsection
