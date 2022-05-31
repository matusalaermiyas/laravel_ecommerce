@extends('layouts.main')

@section('title', 'Admin Login')

@section('content')
<form action="{{route('site.admin.login')}}" method="post" class="col-sm-7 col-sm-offset-1">
    @csrf
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password">
        <br>

        <button type="submit" class="btn btn-info">Login</button>
    </div>
</form>
@endsection