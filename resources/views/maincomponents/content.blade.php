<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <h3>fresh coffee in the morning</h3>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat labore, sint cupiditate distinctio tempora reiciendis.</p>
        <a href="#" class="btn">get yours now</a>
    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h1 class="heading"> <span>about</span> us </h1>

    <div class="row">

        <div class="image">
            <img src="images/about-img.jpeg" alt="">
        </div>

        <div class="content">
            <h3>what makes our coffee special?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus qui ea ullam, enim tempora ipsum fuga alias quae ratione a officiis id temporibus autem? Quod nemo facilis cupiditate. Ex, vel?</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Odit amet enim quod veritatis, nihil voluptas culpa! Neque consectetur obcaecati sapiente?</p>
            <a href="#" class="btn">learn more</a>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- menu section starts  -->

<section class="menu" id="menu">

    <h1 class="heading"> our <span>menu</span> </h1>

    <div class="box-container">
        @foreach ($menus as $menu)
        <div class="box">
            <img src="/storage/{{$menu->image}}" alt="">
            <h3>{{$menu->title}}</h3>
            <div class="price">${{$menu->price}}
                @if ($menu->saleprice)
                <span>${{$menu->saleprice}}</span>
                @endif
            </div>
            <a href="/addcart/{{$menu->id}}" class="btn">add to cart</a>
        </div>
        @endforeach

    </div>

</section>

<!-- menu section ends -->

<section class="products" id="products">

    <h1 class="heading"> our <span>products</span> </h1>

    <div class="box-container">

        @foreach ($products as $product)
        <div class="box">
            <div class="icons">
                <a href="/addcartproduct/{{$product->id}}" class="fas fa-shopping-cart"></a>
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <div class="image">
                <img src="/storage/{{$product->image}}" alt="">
            </div>
            <div class="content">
                <h3>{{$product->title}}</h3>
                <div class="stars">
                    @for ($i = 0;$i < $product->rating;$i++ )
                         <i class="fas fa-star"></i>
                    @endfor
                </div>
                <div class="price">${{$product->price}} <span>${{$product->saleprice}}</span></div>
            </div>
        </div>
        @endforeach

    </div>

</section>

<!-- review section starts  -->

<section class="review" id="review">

    <h1 class="heading"> customer's <span>review</span> </h1>

    <div class="box-container">
        @foreach ($reviews as $review)
        <div class="box">
            <img src="images/quote-img.png" alt="" class="quote">
            <p>{{$review->comment}}</p>
            <img src="/storage/{{$review->image}}" class="user" alt="">
            <h3>{{$review->user_name}}</h3>
            <div class="stars">
                @for ($i=0;$i < $review->rating;$i++)
                <i class="fas fa-star"></i>
                @endfor
                {{-- <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i> --}}
            </div>
        </div>
        @endforeach
    </div>

</section>

<!-- review section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

    <h1 class="heading"> <span>contact</span> us </h1>

    <div class="row">

        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30153.788252261566!2d72.82321484621745!3d19.141690214227783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b63aceef0c69%3A0x2aa80cf2287dfa3b!2sJogeshwari%20West%2C%20Mumbai%2C%20Maharashtra%20400047!5e0!3m2!1sen!2sin!4v1629452077891!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>

        <form action="/create/guest" enctype="multipart/form-data" method="POST">
            @csrf
            <h3>get in touch</h3>
            <div class="inputBox">
                <span class="fas fa-user"></span>
                <input type="text" placeholder="name" name='name'>
            </div>
            <div class="inputBox">
                <span class="fas fa-envelope"></span>
                <input type="email" placeholder="email" name="email">
            </div>
            <div class="inputBox">
                <span class="fas fa-phone"></span>
                <input type="text" placeholder="number" name="phone">
            </div>
            <input type="submit" value="contact now" class="btn">
        </form>

    </div>

</section>

<!-- contact section ends -->

<!-- blogs section starts  -->

<section class="blogs" id="blogs">

    <h1 class="heading"> our <span>blogs</span> </h1>

    <div class="box-container">
        @foreach ($blogs as $blog)
        <div class="box">
            <div class="image" >
                <a href="/blog/{{$blog->id}}">
                    <img src="/storage/{{$blog->image}}" alt="">
                </a>
            </div>
            <div class="content">
                <a href="/blog/{{$blog->id}}" class="title">{{$blog->title}}</a>
                <span>by admin / {{$blog->created_at}}</span>
                <p>{{ \Illuminate\Support\Str::limit($blog->desc, 57, $end='...') }}</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>
        @endforeach

    </div>

</section>

<!-- blogs section ends -->


