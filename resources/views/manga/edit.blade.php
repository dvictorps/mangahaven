
  @extends('layouts.main')     
  @section('title', 'Editando:' . $manga->title)



  @section('content')

  @if ($user_admin == 1 )

    <div id="manga-create-container" class="col-md-6 offset-md-3">
      <h1>Editando: {{$manga->title}}</h1>
      <form action="/manga/update/{{$manga->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
       <p>
        <div class="form-group">
          <label for="image">Capa:</label>
          <input type="file" id="image" name="image" class="from-control-file">
          <img src="/img/manga/cover/{{ $manga->image }}" alt="{{ $manga->title }}" class="img-preview">
        </div>
      </p>
        <div class="form-group">
          <label for="title">Nome:</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Manga" value="{{$manga->title}}">
        </div>
     

        <div class="form-group">
          <label for="title">Descrição:</label>
          <textarea name="description" id="description" class="form-control" placeholder="Descrição">{{ $manga->description }}</textarea>
        </div>
        <div class="form-group">
          <label for="title">Autor:</label>
          <input type="text" class="form-control" id="autor" name="autor" placeholder="Autor"  value="{{ $manga->autor }}">
        </div>

        <div class="form-group">
          <label for="date">Data de publicação:</label>
          <input type="date" class="form-control" id="date" name="date" value="{{ $manga->date->format('Y-m-d') }}">
        </div>

        <div class="form-group">
         
          <label for="title">Selecione as Tags:</label>
         
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Comédia"> Comédia
          
          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Drama"> Drama
          </div>
          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Harem"> Harem
          </div>
          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Isekai"> Isekai
          </div>
          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Webtoon"> Webtoon
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Shoujo"> Shoujo
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Ação"> Ação
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Aventura"> Aventura
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Fantasia"> Fantasia
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Artes Marciais"> Artes Marciais
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Terror"> Terror
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Sobrenatural"> Sobrenatural
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Romance"> Romance
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Seinen"> Seinen
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Shounen"> Shounen
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Yuri"> Yuri
          </div>

          <div class="form-group">	
            <input type="checkbox" name="tags[]" value="Slice of Life"> Slice of Life
          </div>

        </div>
        </div>

        <p>
         <input type="submit" class="btn btn-primary" value="Editar">
        </p>

      </form>
    </div>
    @else

    <p>Você não tem permissão pra acessar esta página</p>

    @endif




  @endsection