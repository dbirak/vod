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

     <!-- Film i jego opis -->

<div class="container">

    @forelse ($film as $f)

     <h1 class="header">{{$f->tytul}}</h1>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-xl-5 col-lg-12 pb-lg-5 pb-sm-5 pb-5 text-center">
                <img src="{{asset($f->link_grafika)}}" class="card-img-top description_img" alt="...">
            </div>
            <div class="col-xl-7 col-lg-12 description">
              <h3 class="description1">Reżyser</h3>
              <h3 class="description2">{{$f->rezyser}}</h3><br>
              <h3 class="description1">Gatunek</h3>
              <h3 class="description2">{{$f->genres->kategoria}}</h3><br>
              <h3 class="description1">Produkcja</h3>
              <h3 class="description2">{{$f->produkcja}}</h3><br>
              <h3 class="description1">Rok produkcji</h3>
              <h3 class="description2">{{$f->rok_produkcji}}</h3><br>
              <h3 class="description1">Czas trwania</h3>
              <h3 class="description2">{{$f->czas_trwania}} minut</h3><br>
              <h3 class="description1">Ocena</h3>
              <h3 class="description2">{{$f->ocena}}</h3><br>
              <h3 class="description1">Opis</h3>
              <h3 class="description2">{{$f->opis}}</h3><br>



            </div>

          </div>
      </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Czy chcesz kupić dostęp do wybranego filmu?</h5>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn signin_button" data-dismiss="modal">Nie</button>
            <a href="/buy/{{$f->id}}"><button type="button" class="btn signin_button">Tak</button></a>
          </div>
        </div>
      </div>
    </div>

        <div class="container mt-5 mb-15">
            <div class="row">
                <div class="col-lg-6 mb-4 buy">
                    <h2 style="font-size: 35px;">Wykup dostęp:</h2>
                    <!--<h2 style="font-size: 35px;">Dostęp wykupiony do:</h2>-->
                </div>
                <div class="col-lg-6 text-center mb-4">
                    <button id="myInput" class="btn buy_button" data-toggle="modal" data-target="#exampleModalCenter">{{$f->cena}} zł / 48 h</button>
                    <!--<h2 style="font-size: 35px;">13:32&nbsp;&nbsp;&nbsp;&nbsp;07-03-2022r.</h2>-->
                </div>
            </div>
        </div>



    <!---->

    <!-- Najnowsze filmy -->

    @empty

    @endforelse

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel();
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
    </script>
  </body>
</html>
