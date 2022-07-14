<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
            <img src="/images/fendi.png" alt="Fendi Logo"
                style="width: 50px; height: 50px;  object-fit:cover; display: inline-block">
            Fendi
        </a>
    </div>
    <div class="collapse navbar-collapse pull-right" id="example-navbar-collapse">
        <ul class="nav navbar-nav">
            @if (Session::has('is_admin'))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Admin (Click here)
                        <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="{{ route('root.paid-customers') }}">
                                Paid customers
                            </a></li>
                        <li><a href="{{ route('root.unpaid-customers') }}">
                                Unpaid customers
                            </a></li>

                        <li><a href="{{ route('root.add-product') }}">
                                Add product
                            </a></li>

                        <li><a href="{{ route('admin.logout') }}">
                                Logout
                            </a></li>
                    </ul>
                </li>
            @endif

            @if (Session::has('customer_logged'))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ Session::get('customer_name') }}
                        <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="{{ route('customer.dashboard') }}">
                                Dashboard
                            </a></li>

                        <li><a href="{{ route('customer.logout') }}">
                                Logout
                            </a></li>
                    </ul>
                </li>
            @else
                <li><a href="{{ route('customer.login') }}">Login | Register</a></li>
            @endif


            <li><a href="{{ route('clothes.tshirts') }}">
                    T-shirts
                </a></li>
            <li><a href="{{ route('clothes.trousers') }}">Trousers</a></li>
            <li><a href="{{ route('clothes.shorts') }}">Shorts</a></li>
            <li><a href="{{ route('clothes.underwears') }}">Underwears</a></li>
            <li><a href="{{ route('clothes.checkout') }}">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    {{ count(session('cart', [])) }}
                </a></li>

        </ul>
    </div>
</nav>
