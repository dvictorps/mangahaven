
  @extends('layouts.main')     
  @section('title', 'Home')


  @section('content')


    
             
        <div id="search-container" class="col-md-12">
          <h1> Buscar Manga </h1>
          <form action="/" method="GET">
              <input type="text" id="search" name = "search" class = "form-control" placeholder="Procurar...">
          </form>
        </div>




    
        <div class="album py-5 bg-light">
          <div class="container">
      
         
            @if($search)
            <h2>Buscando por: {{ $search }}</h2>
          
            @endif
         
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
       
              @foreach($mangas as $manga)
              
              <div class="col">
                <div class="col">
                <div class="card shadow-sm">
                  <img src="img/manga/cover/{{$manga->image}}" width="100%" height="500" >
      
                  <div class="card-body">
                    <h3 class="card-text">{{$manga->title}}</h3>
                    <p class="card-text">{{$manga->description}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="/manga/{{ $manga->id }}"><button type="button" class="btn btn-sm btn-outline-secondary" >Ver mais sobre</button></a>
                        
                      </div>
                      <small class="text-muted">{{$manga->autor}}</small>
                    </div>
                  </div>
                </div>
              </div>
           </div>
           
            @endforeach

            @if(count($mangas) == 0 && $search)
            <p>Não foi possível encontrar nenhum manga com o nome: {{ $search }} </p>
        @elseif(count($mangas) == 0)
            <p>Nenhum manga foi adicionado</p>
        @endif
           
        </div>
              
  @endsection