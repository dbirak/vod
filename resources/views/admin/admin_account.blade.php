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
    <h3 class="description1">Status</h3>
    <h3 class="description2">{{Auth::user()->status}}</h3><br><br>

  </div>

  <!-- Statystyki -->

  <h1 class="header">Statystyki</h1>

    <div class="container mt-5 mb-5">
        <canvas class="ms-auto me-auto" id="myChart" style="width:100%;max-width:1000px;"></canvas>
    </div>

    <div class="container mt-5 mb-5">
        <canvas class="ms-auto me-auto" id="myChart2" style="width:100%;max-width:1000px;"></canvas>
    </div>



    <div class="container mt-5 mb-15">
        <div class="row">
            <div class="col-lg-6 mb-4 buy">
                <h3 style="font-size: 35px;">Liczba użytkowników</h3>
            </div>
            <div class="col-lg-6 text-center mb-4">
                <h3 style="font-size: 35px;">{{$user_count}}</h3>
            </div>
        </div>
    </div>

    <div class="container mt-5 mb-15">
        <div class="row">
            <div class="col-lg-6 mb-4 buy">
                <h3 style="font-size: 35px;">Liczba adminów</h3>
            </div>
            <div class="col-lg-6 text-center mb-4">
                <h3 style="font-size: 35px;">{{$admin_count}}</h3>
            </div>
        </div>
    </div>

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

    <!-- Opcje admina -->

  <h1 class="header">Opcje</h1>

    <div class="container mt-5 mb-5">
        <div class="row ms-auto me-auto text-center">
            <div class="col-12 mb-4 col-md-6 col-xl-3">
              <a href="/admins_list"><button type="submit" class="btn signin_button">Admini</button></a>
            </div>
            <div class="col-12 mb-4 col-md-6 col-xl-3">
                <a href="/users_list"><button type="submit" class="btn signin_button">Użytkownicy</button></a>
              </div>
            <div class="col-12 mb-4 col-md-6 col-xl-3">
                <a href="/films_list"><button type="submit" class="btn signin_button">Filmy</button></a>
            </div>
            <div class="col-12 mb-4 col-md-6 col-xl-3">
                <a href="/edit_name"><button class="btn signin_button">Edytuj dane</button></a>
              </div>
            <div class="col-12 mb-4 col-md-6 col-xl-3">
                <a href="/edit_email"><button type="submit" class="btn signin_button">Edytuj email</button></a>
            </div>
            <div class="col-12 mb-4 col-md-6 col-xl-3">
                <a href="/change_password"><button type="submit" class="btn signin_button">Zmień hasło</button></a>
            </div>
            <div class="col-12 mb-4 col-md-6 col-xl-3">
                <button type="submit" class="btn signin_button" data-toggle="modal" data-target="#exampleModalCenter">Usuń konto</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>


        var xValues = ["Akcja", "Horror", "Fantasy", "Animowany", "Dreszczowiec", "Komedia", "Wojenny", "Przygodowy"];

        var yValues = [
        @forelse ($gatunki as $g)

            @if($g->last)
                {{$g->gatunek}}
            @else
                {{$g->gatunek}},
            @endif

        @empty

        @endforelse
        ];

        var barColors = ["#dd5b82", "#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                backgroundColor: barColors,
                data: yValues
                }]
            },
            options: {
                legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontColor: "#FE9797",
                        fontSize: 19,
                        stepSize: 2,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        fontColor: "#FE9797",
                        beginAtZero: true,
                        maxRotation: 90,
                        minRotation: 0,
                        fontSize: 17
                    }
                }]
            },
                title: {
                    display: true,
                    text: "Liczba filmów z poszczególnych gatunków",
                    fontStyle: "bold",
                    fontSize: 19,
                    fontColor: "#FE9797",
                    padding: 10
                }
            }

        });

        //////////////////////////

        var xValues2 = ["< 1993", "1993 - 1999", "2000 - 2005", "2006 - 2011", "2012 - 2017", "2017 <"];
        var yValues2 = [{{$rok_produkcji[0]}}, {{$rok_produkcji[1]}}, {{$rok_produkcji[2]}}, {{$rok_produkcji[3]}}, {{$rok_produkcji[4]}}, {{$rok_produkcji[5]}}];


        var barColors2 = ["#dd5b82", "#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82","#dd5b82"];

        new Chart("myChart2", {
            type: "bar",
            data: {
                labels: xValues2,
                datasets: [{
                backgroundColor: barColors2,
                data: yValues2
                }]
            },
            options: {
                legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        fontColor: "#FE9797",
                        fontSize: 19,
                        stepSize: 2,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        fontColor: "#FE9797",
                        beginAtZero: true,
                        maxRotation: 90,
                        minRotation: 0,
                        fontSize: 17
                    }
                }]
            },
                title: {
                    display: true,
                    text: "Liczba filmów z poszczególnych lat",
                    fontStyle: "bold",
                    fontSize: 19,
                    fontColor: "#FE9797",
                    padding: 10
                }
            }

        });

    </script>
  </body>
</html>
