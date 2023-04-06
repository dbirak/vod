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

     <!-- O nas -->

<div class="container">

     <h1 class="header">O Nas</h1>

	 <div class="container mt-5 mb-5">
		<div class="row">

			<div class="col-12 col-md-6 text-center">

				<img src="{{asset('storage/about/img1.png')}}" />

			</div>
			<div class="col-12 col-md-6 text-center">
				<br><br><br>
				<h4 class="d-block w-100 pt-4 my-auto">Najlepsze kinowe hity w jednym miejscu!</h4>

			</div>

		</div>
		<br><br><br>
		<div class="row">

			<div class="col-12 col-md-6 text-center">

				<img src="{{asset('storage/about/img2.png')}}" />

			</div>
			<div class="col-12 col-md-6 text-center">
				<br><br><br>
				<h4 class="d-block w-100 pt-4 my-auto">Wypożyczaj filmy kiedy masz na to ochotę!</h4>

			</div>

		</div>
		<br><br><br>
		<div class="row">

			<div class="col-12 col-md-6 text-center">

				<img src="{{asset('storage/about/img3.png')}}" />

			</div>
			<div class="col-12 col-md-6 text-center">
				<br><br><br>
				<h4 class="d-block w-100 pt-4 my-auto">Najlepsze ceny na rynku!</h4>

			</div>

		</div>
	 </div>


	<!-- O stronie -->
  <h1 class="header">O Stronie</h1>

		<div class="container mt-5 mb-15">
			<div class="row">
				<div class="col-lg-6 mb-4 buy">
					<h4>Stronę wykonał</h4>
				</div>
				<div class="col-lg-6 text-center mb-4">
					<h4>Dominik Birak</h4>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6 mb-4 buy">
					<h4>Informacje o filmach</h4>
				</div>
				<div class="col-lg-6 text-center mb-4">
					<h4>FilmWeb.pl</h4>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6 mb-4 buy">
					<h4>Grafiki</h4>
				</div>
				<div class="col-lg-6 text-center mb-4">
					<h4>FlatIcon.com</h4>
				</div>
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
