<!doctype html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('storage/css/style.css')}}" type="text/css"/>

    <link href="{{asset('storage/js/assets/owl.carousel.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Navba -->

    <title>FilmDom</title>
  </head>
  <body class="d-flex flex-column min-vh-100 p-0">

    @if (!Auth::check())

        @include('nav/notlogged')

    @elseif (Auth::user()->status == 'admin')

        @include('nav/admin')

    @else

        @include('nav/user')

    @endif

    <!-- Carousel -->

    <div class="blur-bootom"></div>

    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" style="display: none;" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" style="display: none;" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" style="display: none;" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{asset('storage/carousel/img2.jpg')}}" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h1>Najlepsze kinowe hity!</h1>
            <p></p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{asset('storage/carousel/img1.jpg')}}" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h1>Twoi ulubieni bohaterowie!</h1>
            <p></p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{asset('storage/carousel/img3.jpg')}}" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h1>Wszystko w jednym miejscu!</h1>
            <p></p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="blur-top"></div>

  <!-- Najnowsze filmy -->

 <div class="container">

    @include('cards/latest')

  <!-- Nasz wybór -->

    @include('cards/our_choose')

  <!-- Najwyżej oceniane -->

    @include('cards/rated')

 </div>

  <!-- Stopka -->

  <div class="footer container-fluid bg-light mt-auto">
    <div class="row text-center pt-2 pb-2">
      <div class="text-dark footer_text">
          DOMINIK BIRAK - 2022
      </div>
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('storage/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('storage/js/owl.carousel.js')}}"></script>
    <script src="https://kit.fontawesome.com/a03f72cd48.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel();
            $(".owl-carousel2").owlCarousel();
        });

        $(".owl-carousel1").owlCarousel({
            autoplay: true,
            items: 1,
            loop: true,
            nav: true,
            dots: true,
            autoplayhoverpause: true,
            autoplaytimeout: 100,
            responsiveClass: true,
            responsive: {
                0 : {
                    items: 1,
                    nav: false
                },
                576 : {
                    items: 1,
                    dots: true,
                    nav: false
                },
                768 : {
                    items: 2,
                    nav: false
                },
                992 : {
                    items: 2
                },
                1200 : {
                    items: 3
                },
                1400 : {
                    items: 4
                }
            }
        });

        $(".owl-carousel2").owlCarousel({
            autoplay: true,
            items: 2,
            loop: true,
            nav: true,
            dots: true,
            autoplayhoverpause: true,
            autoplaytimeout: 100,
            responsiveClass: true,
            responsive: {
                0 : {
                    items: 1,
                    nav: false
                },
                576 : {
                    items: 1,
                    dots: true,
                    nav: false
                },
                768 : {
                    items: 1,
                    nav: false
                },
                992 : {
                    items: 1
                },
                1200 : {
                    items: 2
                },
                1400 : {
                    items: 2
                }
            }
        });
    </script>
  </body>
</html>
