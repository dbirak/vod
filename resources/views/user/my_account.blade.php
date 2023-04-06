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


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Czy na pewno chcesz usunąć wybrane konto?</h5>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn signin_button" data-dismiss="modal">Nie</button>
              <a href="/delete_account"><button type="button" class="btn signin_button">Tak</button></a>
            </div>
          </div>
        </div>
      </div>

    <!-- Twoje konto -->

<div class="container">

  <h1 class="header">Twoje Konto</h1>

  <div class="container mt-5 mb-5">
    <h3 class="description1">Imię</h3>
    <h3 class="description2">{{Auth::user()->imie}}</h3><br>
    <h3 class="description1">Nazwisko</h3>
    <h3 class="description2">{{Auth::user()->nazwisko}}</h3><br>
    <h3 class="description1">Adres e-mail</h3>
    <h3 class="description2">{{Auth::user()->email}}</h3><br>
    <h3 class="description1">Stan Konta</h3>
    <h3 class="description2">{{Auth::user()->stan_konta}} zł</h3><br><br>

    <div class="row ms-auto me-auto text-center">
      <div class="col-12 mb-4 col-md-6 col-xl-3">
        <a href="/recharge"><button class="btn signin_button">Doładuj konto</button></a>
      </div>
      <div class="col-12 mb-4 col-md-6 col-xl-3">
        <a href="/edit_name"><button class="btn signin_button">Edytuj dane</button></a>
      </div>
      <div class="col-12 mb-4 col-md-6 col-xl-3">
        <a href="/edit_email"><button class="btn signin_button">Edytuj email</button></a>
      </div>
      <div class="col-12 mb-4 col-md-6 col-xl-3">
        <a href="/change_password"><button class="btn signin_button">Zmień hasło</button></a>
      </div>
      <div class="col-12 mb-4 col-md-6 col-xl-3">
        <button class="btn signin_button" data-toggle="modal" data-target="#exampleModalCenter">Usuń konto</button>
      </div>
    </div>

  </div>



  <!-- Wypożyczone filmy -->

  <h1 class="header">Wypożyczone Filmy</h1>

  <div class="container mt-5 mb-5">

      <div class="row">

            @forelse ($wypozyczone as $f)

                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mb-5">
                    <div class="card">
                        <img style="max-width: 282px; max-height: 402px" src="{{asset($f->films->link_grafika)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{$f->films->tytul}}</h5>
                        <p class="card-text">{{$f->films->genres->kategoria}}</p>
                        <a href="/film/{{$f->films->id}}" class="btn">Więcej</a>
                        </div>
                    </div>
                </div>

            @empty

                <h4 class="col-12 text-center">Brak filmów do wyświetlenia!</h4>

            @endforelse

      </div>

  </div>
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
