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

    <!-- Formularz dodawania admina -->
<div class="container">
    <h1 class="header">Dodaj admina</h1>

    <div class="container mt-5 mb-5">
        <form method="POST" action="/add_admin_form">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="form-row align-items-center">
              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Imię</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                  </div>
                  <input name="imie" type="text" class="form-control" >
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Nazwisko</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                  </div>
                  <input name="nazwisko" type="text" class="form-control" >
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Adres e-mail</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-envelope"></i></div>
                  </div>
                  <input name="email" type="text" class="form-control" >
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Hasło</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-key"></i></div>
                  </div>
                  <input name="haslo" type="password" class="form-control" >
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Powtórz hasło</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-key"></i></div>
                  </div>
                  <input name="haslo2" type="password" class="form-control" id="inlineFormInputGroupUsername">
                </div>
              </div>

              <br>

              <h5 class="error">@error('imie') {{$message}} <br>@enderror @error('nazwisko') {{$message}} <br>@enderror  @error('email') {{$message}} <br>@enderror @error('haslo') {{$message}} <br>@enderror @error('haslo2') {{$message}} <br>@enderror @if(Session::has('fail')) {{Session::get('fail')}}  @endif</h5>
              <br>

              <div class="col-auto my-1 ms-auto me-auto text-center">
              </div>
              <div class="col-auto my-1 ms-auto me-auto text-center">
                <button type="submit" class="btn signin_button">Dodaj admina</button>
              </div>
            </div>

          </form>

    </div>

    <!-- Najnowsze filmy -->

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
    </script>
  </body>
</html>
