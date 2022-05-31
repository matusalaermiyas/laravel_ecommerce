@extends('layouts.main')

@section('title', 'Login')

@section('content')
    <div class="row">
        <form action="{{ route('customer.login.post') }}" method="post" class="col-sm-7 col-sm-offset-1">
            @csrf
            @include('layouts.input', ['id' => 'email', 'label' => 'Email', 'type' => 'email'])
            @include('layouts.input', ['id' => 'password', 'label' => 'Password', 'type' => 'password'])
            @include('layouts.button', ['label' => 'Login'])
            <a href="{{ route('customer.register') }}">Don't have account create</a>
        </form>
    </div>
@endsection

@if (Session::has('account-created'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            SoloAlert.alert({
                title: "Account created successfully, you can login",
                icon: "success"
            });
        })
    </script>
@endif
