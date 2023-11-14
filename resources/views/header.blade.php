<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ECommerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                @auth
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/update-user-details/{{ auth()->user()->id }}">{{ auth()->user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                <li class="nav-item" style="margin-left: 10px;">
                    @auth
                        @php
                            $userCart = auth()->user()->cart;
                            $cartItemCount = $userCart ? $userCart->cartItems : null;
                            $cartItemCount = $cartItemCount ? $cartItemCount->count() : 0;
                        @endphp
                        @if($userCart)
                            <a class="nav-link" href="/cart/{{ $userCart->id }}">
                                Cart
                                @if($cartItemCount > 0)
                                    <span class="badge bg-danger">{{ $cartItemCount }}</span>
                                @endif
                            </a>
                        @endif
                    @endauth
                </li>
                
                @else
                <li class="nav-item">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Register</a>
                </li>

                
                @endauth

            </ul>
        </div>
    </div>
</nav>

