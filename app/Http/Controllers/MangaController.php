<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Manga;

use App\Models\User;

class MangaController extends Controller
{

    public function index(){

        $search = request('search');
        
        $user = auth()->user();

        


        if ($search){

            $mangas = Manga::where([

                ['title',  'like', '%' .$search. '%']

            ])->get();


        } else{ 

            $mangas = Manga::all();

        }

        

        return view('home',['mangas'=> $mangas, 'search' => $search, 'user' => $user]);

    }
  
    public function add() {

        $user = auth()->user();
        
        $user_admin = $user->is_admin;

        return view('manga.add', ['user'=> $user, 'user_admin' => $user_admin]);
    }    

    public function store(Request $request){

        $manga = new Manga;
        
        $manga->title = $request->title;
        $manga->date = $request->date;
        $manga->description = $request->description;
        $manga->autor = $request->autor;
        $manga->tags = $request->tags;
        

        //upload de imagens

        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/manga/cover'), $imageName);

            $manga->image = $imageName;
        }
        
        $user = auth()->user();

        $manga->user_id = $user->id;
        
        $manga->save();

        return redirect('/')->with('msg', 'Manga adicionado com sucesso');



    }


    public function show($id){

        $manga = Manga::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {

            $userMangas = $user->mangasAsParticipants->toArray();

            foreach($userMangas as $userManga){
                if($userManga['id'] == $id){

                        $hasUserJoined = true;
                }

            }

        }


        $mangaOwner = User::where('id', $manga->user_id)->first()->toArray();

        return view('manga.show', ['manga' => $manga, 'mangaOwner' => $mangaOwner, 'hasUserJoined' => $hasUserJoined]);

    }

    public function dashboard(){

        $user = auth()->user();

        $user_admin = $user->is_admin;

        $mangas = $user->mangas;

        $mangasAsParticipants = $user->mangasAsParticipants;

        return view('manga.dashboard', 
        ['mangas' => $mangas, 'user_admin' => $user_admin, 'mangasAsParticipants' => $mangasAsParticipants]);

    }

    public function destroy($id){

        Manga::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Manga removido com sucesso');


    }

    public function edit($id) {

        $user = auth()->user();

        $user_admin = $user->is_admin;

        $manga = Manga::findOrFail($id);

        return view('manga.edit', ['manga' => $manga, 'user_admin' => $user_admin]);

    }

    public function update(Request $request){

            $data = $request->all();

            if($request->hasFile('image') && $request->file('image')->isValid()) {

                $requestImage = $request->image;
    
                $extension = $requestImage->extension();
    
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
    
                $requestImage->move(public_path('img/manga/cover'), $imageName);
    
                $data['image'] = $imageName;
            }
            

            Manga::findOrFail($request->id) ->update($data);

            return redirect('/dashboard')->with('msg', 'Manga editado com sucesso');
    }


        public function readManga($id){

            $user = auth()->user();

            $user->mangasAsParticipants()->attach($id);

            $manga = Manga::findOrFail($id);

            return redirect('/dashboard')->with('msg', 'O manga ' . $manga->title . ' foi adicionado a sua lista.');


            
        }

        public function leaveManga($id){

            $user = auth()->user();

            $manga = Manga::findOrFail($id);

            $user->mangasAsParticipants()->detach($id);

            return redirect('/dashboard')->with('msg', 'Você removeu o manga da sua lista com sucesso');
            
        }



}
