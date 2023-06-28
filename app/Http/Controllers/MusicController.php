<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Routing\Controller;

class MusicController extends Controller
{
    public function index(Request $request)
    {
        $arrayToSend = array();
        $arrayToSend['musics'] = DB::table('musics')->get();
        $userId = $request->cookie('id');
        if(!is_null($userId)){
            $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;
        }

        return view('music/index', 
        $arrayToSend
    );
    }

    public function detail($musicId,Request $request){
        $arrayToSend = array();
        $arrayToSend['music'] = DB::table('musics')->find($musicId);
        $userId = $request->cookie('id');
        if(!is_null($userId)){
            $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;
        }

        return view('music\detail', 
        $arrayToSend);
    }
    public function addMusic(Request $request){

        $pathMusic = $request->file('musicFile')->storeAs('musics', $request->musicFile->getClientOriginalName(), 'public');
        $pathImage = $request->file('imageFile')->storeAs('images', $request->imageFile->getClientOriginalName(), 'public');

        DB::table('musics')->insert([
            'year'=>$request->year,
            'name'=>$request->name,
            'author'=>$request->author,
            'duration'=>$request->duration,
            'imagepath'=>$pathImage,
            'musicpath'=>$pathMusic,
            'text'=>$request->text,
        ]);
        return redirect('/');
    }
    public function addMusicPage(Request $request){
        $arrayToSend = array();
        $userId = $request->cookie('id');
        if(!is_null($userId)){
            $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;
        }

        return view('music/add',$arrayToSend);
    }

    
    public function deleteMusic($musicId){
        
        
        $music = DB::table('musics')->get($musicId);
        unlink(storage_path('app/public/'.$music->imagepath));
        unlink(storage_path('app/public/'.$music->musicpath));

        DB::delete('DELETE FROM musics WHERE id = ?',[$musicId]);

        return redirect('/');
    }
    
    public function searchMusic(Request $request){

        $arrayToSend = array();
        $userId = $request->cookie('id');
        if(!is_null($userId)){
            $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;
        }


        $text = $request->text;

        $arrayToSend['musicByName'] = DB::table('musics')->where('name','LIKE','%'.$text.'%')->get();
        $arrayToSend['musicByAuthor'] = DB::table('musics')->where('author','LIKE','%'.$text.'%')->get();
        $arrayToSend['musicByText'] = DB::table('musics')->where('text','LIKE','%'.$text.'%')->get();

        $arrayToSend['searchText'] = $text;

        return view('music/search',$arrayToSend);
    }


    public function editMusic(Request $request){

        $music = DB::table('musics')->find($request->id);
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

        DB::table('musics')
        ->where('id', $request->id)
        ->update([
            'year' => $request->year,
            'name' => $request->name,
            'author' => $request->author,
            'duration' => $request->duration,
            'text' => $request->text,
            'imagepath' => ($pathImage??$music->imagepath),
            'musicpath' => ($pathMusic??$music->musicpath)
        ]);
        return redirect('/');
    }
    public function editMusicPage($musicId,Request $request){
        $arrayToSend = array();
        $userId = $request->cookie('id');
        if(!is_null($userId)){
            $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;
        }

        $arrayToSend['music'] = DB::table('musics')->find($musicId);
        
        return view('music/edit',
        $arrayToSend
    );
    }
}