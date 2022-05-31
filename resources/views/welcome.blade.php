@extends('layouts.main')

@section('title', 'Welcome')

@section('content')
    <h1 style="font-size: 30px">Welcome to Fendi</h1>
    <p style="color: skyblue; font-style: italic">We of offer the following items in our clothe's site</p>

    <p style="color: skyblue; font-style: italic">In order to track your orders it's better if you create an account
    </p>

    <div class="flexslider">
        <ul class="slides" style="width: 100%; height: 300px !important;">
            <li>
                <img src="/images/trousers/black.jpg" style="height: 300px; width: 100% !important; object-fit: contain" />
                <p class="flex-caption">Nice and Quality Trousers</p>
            </li>
            <li>
                <img src="/images/trousers/jeans.jpg" style="height: 300px; width: 100% !important; object-fit: contain" />
            </li>
        </ul>
    </div>

    <div class="flexslider">
        <ul class="slides" style="width: 100%; height: 300px !important;">
            <li>
                <img src="/images/tshirts/black.png" style="height: 300px; width: 100% !important; object-fit: contain" />
                <p class="flex-caption">Nice and Quality T-Shirts</p>
            </li>

            <li>
                <img src="/images/tshirts/blue.jpg" style="height: 300px; width: 100% !important; object-fit: contain" />
            </li>
            <li>
                <img src="/images/tshirts/grey.png" style="height: 300px; width: 100% !important; object-fit: contain" />
            </li>
            <li>
                <img src="/images/tshirts/yellow.jpg" style="height: 300px; width: 100% !important; object-fit: contain" />
            </li>
        </ul>
    </div>

    <div class="flexslider">
        <ul class="slides" style="width: 100%; height: 300px !important;">
            <li>
                <img src="/images/shorts/brown.jpg" style="height: 300px; width: 100% !important; object-fit: contain" />
                <p class="flex-caption">Nice and Quality Shorts</p>
            </li>
            <li>
                <img src="/images/shorts/jeans.jpg" style="height: 300px; width: 100% !important; object-fit: contain" />
            </li>
            <li>
                <img src="/images/shorts/red.jpg" style="height: 300px; width: 100% !important; object-fit: contain" />

            </li>
        </ul>
    </div>

    <div class="flexslider">
        <ul class="slides" style="width: 100%; height: 300px !important;">
            <li>
                <img src="/images/underwears/black.png"
                    style="height: 300px; width: 100% !important; object-fit: contain" />
                <p class="flex-caption">Nice and Quality Underwears</p>
            </li>
            <li>
                <img src="/images/underwears/jockey.png"
                    style="height: 300px; width: 100% !important; object-fit: contain" />
            </li>
        </ul>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $('.flexslider').flexslider({
                slideshowSpeed: 3000,
            });
        })
    </script>
@endsection

@if (Session::has('payment-success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            SoloAlert.alert({
                title: "Payment Successful, we will deliver your item as soon as possible",
                icon: "success"
            });
        })
    </script>
@endif
