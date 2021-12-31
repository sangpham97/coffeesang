<header class="header">

    <a href="#" class="logo">
        <img src="images/logo.png" alt="">
    </a>

    <nav class="navbar">
        <a class="navbar__item " href="#home">home</a>
        <a class="navbar__item " href="#about">about</a>
        <a class="navbar__item " href="#menu">menu</a>
        <a class="navbar__item " href="#products">products</a>
        <a class="navbar__item " href="#review">review</a>
        <a class="navbar__item " href="#contact">contact</a>
        <a class="navbar__item " href="#blogs">blogs</a>
         @if (Route::has('login'))
                <div style="display: inline-flex">
                    @auth
                        <a class="navbar__item " href="{{ url('/home') }}" >{{auth()->user()->name}}</a>
                    @else
                        <a class="navbar__item " href="{{ route('login') }}" >Log in</a>

                        @if (Route::has('register'))
                            <a class="navbar__item " href="{{ route('register') }}" >Register</a>
                        @endif
                    @endauth
                </div>
            @endif
    </nav>

    <div class="icons">
        <div class="fas fa-search" id="search-btn"></div>
        <div class="fas fa-shopping-cart" id="cart-btn"></div>
        <div class="fas fa-bars" id="menu-btn"></div>

    </div>

    <div class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </div>

    <div class="cart-items-container">
        @foreach ($cart as $item)
        <div class="cart-item">
            <a href="/removecart/{{$item->rowId}}">
                <span class="fas fa-times"></span>
            </a>
            <img src="/storage/{{$item->options->image}}" alt="">
            <div class="content">
                <h3>{{$item->name}}</h3>
                <div class="price">${{$item->price}}/{{$item->qty}}</div>
            </div>
        </div>
        @endforeach

        <div >
            <h4 >Total:{{$totalPrice}}$</h4>
        </div>
        <a href="/checkout" class="btn">checkout now</a>
    </div>

</header>
