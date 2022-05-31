@extends('layouts.main')

@section('title', 'Make payment')

@section('content')
    <form action="{{ route('customer.stripe.post') }}" method="POST" data-cc-on-file="false"
        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" class="col-sm-7 col-sm-offset-1 require-validation"
        id="form">
        @csrf

        <input type="hidden" name="stripeToken" id="stripeToken">

        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                &times;
            </button>
            <p>Total amount: {{ session()->get('total_price') }} Birr</p>
        </div>

        <div class="form-group">
            <label for="card-number">Card number</label>
            <input type="text" class="form-control" id="card-number" required value="4242424242424242">
        </div>
        <div class="form-group">
            <label for="cvc">CVC</label>
            <input type="text" class="cvc form-control" id="cvc" required value="123">
        </div>
        <div class="form-group">
            <label for="exp-month">Expiration Month</label>
            <input type="text" class="form-control" id="exp-month" required value="04">
        </div>
        <div class="form-group">
            <label for="exp-year">Expiration Year</label>
            <input type="text" class="form-control" id="exp-year" required value="2030">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </div>
    </form>

@section('scripts')
    @if (Session::has('payment-error'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                SoloAlert.alert({
                    title: "Error during payment try again",
                    icon: "error"
                });
            })
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            $("#form").on('submit', e => {
                e.preventDefault();

                var $form = $('#form');

                const resHandler = (status, res) => {
                    if (res.error) {
                        console.log(res.error);
                        alert('Error occured');
                    } else {

                        const token = res['id'];
                        $('#stripeToken').attr('value', token);

                        document.getElementById('form').submit();
                    }
                }

                if (!$form.data('cc-on-file')) {
                    try {
                        Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                        Stripe.createToken({
                            number: $('#card-number').val(),
                            cvc: $('#cvc').val(),
                            exp_month: $('#exp-month').val(),
                            exp_year: $('#exp-year').val()
                        }, resHandler);
                    } catch (ex) {
                        alert('Unexpected error occured, Check your internet connection')
                    }

                }
            })
        })
    </script>
@endsection
@endsection
