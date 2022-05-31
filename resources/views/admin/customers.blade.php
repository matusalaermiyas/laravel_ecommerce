@extends('layouts.main')

@section('title', 'Customers')

@section('content')
    <div class="row">
        @if ($status)
            <h1>List of paid customers waiting for delivery</h1>
        @else
            <h1>List of customer started the order but not payed the cash</h1>
        @endif
        <div class="col-sm-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Region</th>
                        <th>Kebele</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->region }}</td>
                            <td>{{ $customer->kebele }}</td>
                            <td>
                                <a href="{{route('customer.orders', $customer->id)}}">Watch orders</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-12">
            {{ $customers->links() }}
        </div>

    </div>
@endsection
