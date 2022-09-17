
  @extends('layouts.main')     
  @section('title', $manga->title)


  @section('content')



  <div class="col-md-10 offset-md-1">
    <div class="row">
      <div id="image-container" class="col-md-6">
        <img src="/img/manga/cover/{{ $manga->image }}" class="img-fluid" alt="{{ $manga->title }}">
      </div>
      <div id="info-container" class="col-md-6">
        <h1>{{ $manga->title }}</h1>
        <p class="manga-autor"><ion-icon name="person-outline"></ion-icon> {{ $manga->autor }}</p>

        <p>{{ date('d/m/Y', strtotime($manga->date)) }}</p>
        <br>

        <p class="manga-description">{{ $manga->description }}</p>
             
        <br>

        <div class="ppl-reading">

        <p>  {{ count($manga->users) }} pessoas estão lendo este manga.</p>
        <br>

        </div>
      
        <div class="tag-container">
        <h3>Tags:</h3>

        </div>
        
      <div class="tag-container-2">
        @foreach ($manga->tags as $tag)
          
        <span> {{$tag}},  </span> 

        @endforeach
        
      </div>
      

        <div class="status-container">
        <h3> Status: <h3>

          
          @if(!$hasUserJoined)
          <form action="/manga/read/{{ $manga->id }}" method="POST">
            @csrf
            <a href="/manga/read/{{ $manga->id }}" 
              class="btn btn-primary" 
              id="manga-submit"
              onclick="manga.preventDefault();
              this.closest('form').submit();">
              Adicionar manga a minha lista
            </a>
          </form>
        @else
          <p class="already-joined-msg">Esse mangá já se encontra na sua lista</p>
        @endif
        
        </div>


        
          
      </div>

      
      <p>Adicionado por {{ $mangaOwner['name'] }}</p>

   

     </div>
   </div>


  @endsection