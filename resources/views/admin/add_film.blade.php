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

    <!-- Formularz dodawania filmu -->
<div class="container">
    <h1 class="header">Dodaj Film</h1>

    <div class="container mt-5 mb-5">
        <form method="POST" action="/add_film_admin">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="form-row align-items-center">
              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Tytuł</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-clapperboard"></i></div>
                  </div>
                  <input name="tytul" type="text" class="form-control" value="">
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Reżyser</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                  </div>
                  <input name="rezyser" type="text" class="form-control" value="">
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Gatunek</label><br>
                <select name="gatunek" class="custom-select" id="inputGroupSelect03">
                    <option selected value="1">Akcja</option>
                    <option value="2">Horror</option>
                    <option value="3">Fantasy</option>
                    <option value="4">Animowany</option>
                    <option value="5">Dreszczowiec</option>
                    <option value="6">Komedia</option>
                    <option value="7">Wojenny</option>
                    <option value="8">Przygodowy</option>
                  </select>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Produkcja</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-flag"></i></div>
                  </div>
                  <input name="produkcja" type="text" class="form-control" value="">
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Rok produkcji</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-calendar-days"></i></div>
                  </div>
                  <input name="rok_produkcji" type="number" min="1" data-bind="value:replyNumber" class="form-control number-form" step="1" value="">
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Czas trwania (min)</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-stopwatch"></i></div>
                  </div>
                  <input name="czas_trwania" type="number" min="1" data-bind="value:replyNumber" class="form-control number-form" step="1" value="">
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Ocena</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-star"></i></div>
                  </div>
                  <input name="ocena" type="number" min="1" data-bind="value:replyNumber" class="form-control number-form" step="0.01" value="">
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Opis</label>
                <div class="input-group">
                  <textarea name="opis" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Link do grafiki</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-image"></i></div>
                  </div>
                  <input name="link_grafika" type="text" class="form-control" value="">
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Link do filmu</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-clapperboard"></i></div>
                  </div>
                  <input name="link_film" type="text" class="form-control" value="">
                </div>
              </div>

              <br><br>

              <div class="col-10 col-sm-10 col-md-8 col-lg-6 col-xl-5 my-1 form-container ms-auto me-auto">
                <label class="label-form" for="inlineFormInputGroupUsername">Cena</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-money-bill-1"></i></div>
                  </div>
                  <input name="cena" type="number" min="1" data-bind="value:replyNumber" class="form-control number-form" step="0.01">
                </div>
              </div>

              <br>

              <h5 class="error">@error('tytul') {{$message}} <br>@enderror @error('rezyser') {{$message}} <br>@enderror  @error('gatunek') {{$message}} <br>@enderror @error('produkcja') {{$message}} <br>@enderror @error('rok_produkcji') {{$message}} <br>@enderror @error('czas_trwania') {{$message}} <br>@enderror @error('ocena') {{$message}} <br>@enderror @error('opis') {{$message}} <br>@enderror  @error('link_grafika') {{$message}} <br>@enderror @error('link_film') {{$message}} <br>@enderror @error('cena') {{$message}} <br>@enderror @if(Session::has('fail')) {{Session::get('fail')}}  @endif</h5>
              <br>

              <div class="col-auto my-1 ms-auto me-auto text-center">
              </div>
              <div class="col-auto my-1 ms-auto me-auto text-center">
                <button type="submit" class="btn signin_button">Dodaj</button>
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
