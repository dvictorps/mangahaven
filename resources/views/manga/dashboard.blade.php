@extends('layouts.main')

@section('title', 'Dasboard')

@section('content')

@if ($user_admin == 1)
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Mangas</h1>
</div>
@endif

<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($mangas) > 0)

    @if($user_admin == 1 )

    <div class="add-manga">

    <a href="/manga/add" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Adicionar Manga</a> 

    </div>

    @endif

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Leitores</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mangas as $manga)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/manga/{{ $manga->id }}">{{ $manga->title }}</a></td>
                    <td>{{count($manga->users)}}</td>

                            <td>
                            
                                <a href="/manga/edit/{{ $manga->id }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a> 
                                <form action="/manga/{{ $manga->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                                </form>
                            
                            </td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    @else

    @if($user_admin == 1 )
    <p>Você ainda não adicionou nenhum manga a sua lista</p>
    @endif

    
    
    @endif
</div>

<br>

<br>

<br>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Mangas que estou lendo</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($mangasAsParticipants) > 0)



    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Leitores</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mangasAsParticipants as $manga)
                <tr>
                    <td scropt="row">{{ $loop->index + 1 }}</td>
                    <td><a href="/manga/{{ $manga->id }}">{{ $manga->title }}</a></td>
                    <td>{{count($manga->users)}}</td>

                            <td>
                            
                                <form action="/manga/leave/{{ $manga->id }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon> 
                                        Remover da lista
                                    </button>
                                </form>
                            
                            </td>
                </tr>
            @endforeach    
        </tbody>
    </table>






    @else 
    
    
    <p>Você ainda não adicionou nenhum manga a sua lista</p>
    
    
    @endif


</div>



@endsection