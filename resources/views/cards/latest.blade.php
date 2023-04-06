<h1 class="header">Najnowsze Filmy</h1>

    <div class="container mt-5 mb-5">
      <div class="owl-carousel owl-carousel1 owl-theme">
            @forelse ($naj_film as $f)

            <div class="ms-0 me-0">
                <div class="card">
                    <img src="{{asset($f->link_grafika)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                       <h5 class="card-title">{{$f->tytul}}</h5>
                       <p class="card-text">{{$f->genres->kategoria}}</p>
                       <a href="/film/{{$f->id}}" class="btn">Więcej</a>
                    </div>
                 </div>
              </div>

            @empty
                <h5>Brak elementów!</h5>
            @endforelse

      </div>
  </div>
