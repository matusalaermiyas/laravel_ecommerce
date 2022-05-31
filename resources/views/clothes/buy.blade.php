@extends('layouts.main')

@section('title', 'Fill your form')

@section('content')
    <div class="col-sm-6 col-sm-offset-1">
        <form method="POST" action="{{route('customer.submit')}}">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" name="name" placeholder="Jhon Doe" required> 
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" name="phone" placeholder="0910203040" required>
            </div>
            <div class="form-group">
                <label for="region">Region</label>
                <input type="text" class="form-control" name="region" placeholder="E.g. Adama" required>
            </div>
            <div class="form-group">
                <label for="kebele">Kebele</label>
                <input type="text" class="form-control" name="kebele" placeholder="09" required>
                <br>
                <button class="btn btn-info">Done</button>
            </div>
        </form>
    </div>

@endsection
