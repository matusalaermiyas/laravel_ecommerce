@extends('layouts.main')

@section('title', 'Register')

@section('content')
    <div class="row">
        <div class="col-sm-7 col-sm-offset-1">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <form action="{{ route('customer.register.post') }}" method="post" class="col-sm-7 col-sm-offset-1">
            @csrf
            @include('layouts.input', ['id' => 'email', 'label' => 'Email', 'type' => 'email'])
            @include('layouts.input', ['id' => 'username', 'label' => 'Username', 'type' => 'text'])
            @include('layouts.input', ['id' => 'password', 'label' => 'Password', 'type' => 'password'])
            @include('layouts.button', ['label' => 'Login'])
            <a href="{{ route('customer.login') }}">Have an account login</a>
        </form>
    </div>
@endsection
