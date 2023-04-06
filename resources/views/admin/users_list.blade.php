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

    <!-- Wszyscy użytkownicy -->

<div class="container">

  <h1 class="header">Lista Użytkowników</h1>

  <div class="container mt-5 mb-5">

    <form action="/users_serach_admin" method="POST">
        @csrf <!-- {{ csrf_field() }} -->
      <div class="row text-center">

          <div class="mb-2 col-12 col-md-8 col-lg-9">

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto serach_input">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></div>
                    </div>
                    <input name="szukaj" type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{$serach}}">
                  </div>
                </div>

          </div>

          <div class="col-12 col-md-4 mb-5 col-lg-3 mt-1">

              <button type="submit" class="btn buy_button serach_button">Szukaj</button>

          </div>

      </div>
    </form>



      <div class="row">


            @forelse ($users as $f)
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-3 mb-5">
                <div class="card">

                    <div class="card-body">
                       <h5 class="description1">Imię</h5>
                       <h5 class="description2">{{$f->imie}}</h5><br>

                       <h5 class="description1">Nazwisko</h5>
                       <h5 class="description2">{{$f->nazwisko}}</h5><br>

                       <h5 class="description1">Adres e-mail</h5>
                       <h5 class="description2">{{$f->email}}</h5><br>

                       <a href="/delete_user/{{$f->id}}" class="btn">Usuń</a>
                    </div>
                 </div>
              </div>
            @empty

                <h4 class="col-12 text-center">Brak użytkowników do wyświetlenia!</h4>

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
