<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Storage;

class MusicController extends Controller
{


    public function index()
    {
        $musics = DB::select('SELECT * FROM musics');

        return view('music/index', 
        array(
            'musics' => $musics
        )
    );
    }

    public function detail($musicId){
        $music = DB::select('SELECT * FROM musics WHERE id = ?',[$musicId])[0];

        return view('music\detail', 
        array(
            'music' => $music
        ));
    }
    public function addMusic(Request $request){
        // $music = DB::select('SELECT * FROM musics WHERE id = ?',[$musicId])[0];

        $pathMusic = $request->file('musicFile')->storeAs('musics', $request->musicFile->getClientOriginalName(), 'public');
        $pathImage = $request->file('imageFile')->storeAs('images', $request->imageFile->getClientOriginalName(), 'public');

        DB::insert('INSERT INTO musics (year,name,author,duration,imagepath,musicpath,text)
        VALUES (?, ?, ?, ?, ?, ?, ?)', [
            $request->year,
            $request->name,
            $request->author,
            $request->duration,
            $pathImage,
            $pathMusic,
            $request->text,
        ]);
        return redirect('/');
    }
    public function addMusicPage(){
        
        return view('music/add');
    }

    
    public function deleteMusic($musicId){
        
        $music = DB::select('SELECT * FROM musics WHERE id = ?',[$musicId])[0];
        unlink(storage_path('app/public/'.$music->imagepath));
        unlink(storage_path('app/public/'.$music->musicpath));

        DB::delete('DELETE FROM musics WHERE id = ?',[$musicId]);

        return redirect('/');
    }
    
    public function searchMusic(Request $request){
        $text = $request->text;

        $musicByName   = DB::select('SELECT * FROM musics WHERE name LIKE ?',['%'.$text.'%']);
        $musicByAuthor = DB::select('SELECT * FROM musics WHERE author LIKE ?',['%'.$text.'%']);
        $musicByText   = DB::select('SELECT * FROM musics WHERE text LIKE ?',['%'.$text.'%']);


        return view('music/search',[
            'musicByName' => $musicByName,
            'musicByAuthor' => $musicByAuthor,
            'musicByText' => $musicByText,
            'searchText' => $text
        ]);
    }


    public function editMusic(Request $request){

        $music = DB::select('SELECT * FROM musics WHERE id = ?',[$request->id])[0];
        $pathMusic = null;
        $pathImage = null;
        if($request->musicFile!='')
        {
            unlink(storage_path('app/public/'.$music->musicpath));
            $pathMusic = $request->file('musicFile')->storeAs('musics', $request->musicFile->getClientOriginalName(), 'public');
        }

        if($request->imageFile!='')
        {
            unlink(storage_path('app/public/'.$music->imagepath));
            $pathImage = $request->file('imageFile')->storeAs('images', $request->imageFile->getClientOriginalName(), 'public');
        }



        DB::update('UPDATE musics SET 
        year = ?,
        name = ?,
        author = ?,
        duration = ?,
        imagepath = ?,
        musicpath = ?,
        text = ?

        WHERE id = ?
        ', [
            $request->year,
            $request->name,
            $request->author,
            $request->duration,
            $pathImage??$music->imagepath,
            $pathMusic??$music->musicpath,
            $request->text,
            $request->id,
        ]);
        return redirect('/');
    }
    public function editMusicPage($musicId){
        $music = DB::select('SELECT * FROM musics WHERE id = ?',[$musicId])[0];
        
        return view('music/edit',[
            'music' => $music
        ]);
    }
}