<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use Illuminate\Routing\Controller;
use wapmorgan\Mp3Info\Mp3Info;

class MusicController extends Controller
{
    public function index(Request $request)
    {
        $arrayToSend = array();
        $userId = $request->cookie('id');
        if(is_null($userId)){
            return redirect('login');    
        }
        $arrayToSend['musics'] = DB::table('musics')->where('userId','=',$userId)->get();
        $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;
        return view('music/index', 
        $arrayToSend
    );
    }

    public function detail($musicId,Request $request){
        $arrayToSend = array();
        $arrayToSend['music'] = DB::table('musics')->find($musicId);
        $userId = $request->cookie('id');
        if(is_null($userId)){
            return redirect('login');    
        }
        $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;

        return view('music\detail', 
        $arrayToSend);
    }
    public function addMusic(Request $request){

        $loginUser = DB::table('users')->find($request->cookie('id'))->login;
        $pathMusic = $request->file('musicFile')->storeAs('musics/'.$loginUser, Str::random().'.'.$request->file('musicFile')->extension(), 'public');
        $pathImage = $request->file('imageFile')->storeAs('images/'.$loginUser, Str::random().'.'.$request->file('imageFile')->extension(), 'public');

        $audio = new Mp3Info(storage_path('app/public/'.$pathMusic), true);

        $text = $request->text;
        if(is_null($text)&&!is_null($request->file('textFile'))){
            $text = $request->file('textFile')->getContent();
        }

        DB::table('musics')->insert([
            'year'=>$request->year,
            'name'=>$request->name,
            'author'=>$request->author,
            'duration'=>floor($audio->duration / 60).':'.floor($audio->duration % 60),
            'imagepath'=>$pathImage,
            'musicpath'=>$pathMusic,
            'text'=>$text,
            'userId'=>$request->cookie('id')
        ]);
        return redirect('/');
    }
    public function addMusicPage(Request $request){
        $arrayToSend = array();
        $userId = $request->cookie('id');
        if(is_null($userId)){
            return redirect('login');    
        }
        $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;

        return view('music/add',$arrayToSend);
    }

    
    public function deleteMusic($musicId){
        
        
        $music = DB::table('musics')->find($musicId);
        unlink(storage_path('app/public/'.$music->imagepath));
        unlink(storage_path('app/public/'.$music->musicpath));

        DB::delete('DELETE FROM musics WHERE id = ?',[$musicId]);

        return redirect('/');
    }
    
    public function searchMusic(Request $request){

        $arrayToSend = array();
        $userId = $request->cookie('id');
        if(is_null($userId)){
            return redirect('login');    
        }
        $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;


        $text = $request->text;

        $arrayToSend['musicByName'] = DB::table('musics')
                                                ->where('userId','=',$userId)
                                                ->where('name','LIKE','%'.$text.'%')
                                                ->get();
        $arrayToSend['musicByAuthor'] = DB::table('musics')
                                                ->where('userId','=',$userId)
                                                ->where('author','LIKE','%'.$text.'%')
                                                ->get();
        $arrayToSend['musicByText'] = DB::table('musics')
                                                ->where('userId','=',$userId)
                                                ->where('text','LIKE','%'.$text.'%')
                                                ->get();

        $arrayToSend['searchText'] = $text;

        return view('music/search',$arrayToSend);
    }


    public function editMusic(Request $request){

        $music = DB::table('musics')->find($request->id);
        $music = DB::table('musics')->find($request->id);
        $pathMusic = $music->musicpath;
        $pathImage = $music->imagepath;
        $duration = $music->duration;
        
        $text = $request->text;
        if(is_null($text)&&!is_null($request->file('textFile'))){
            $text = $request->file('textFile')->getContent();
        }

        $loginUser = DB::table('users')->find($request->cookie('id'))->login;
        if($request->musicFile!='')
        {
            unlink(storage_path('app/public/'.$music->musicpath));
            $pathMusic = $request->file('musicFile')->storeAs('musics/'.$loginUser, Str::random().'.'.$request->file('musicFile')->extension(), 'public');
            $audio = new Mp3Info(storage_path('app/public/'.$pathMusic), true);
            $duration = floor($audio->duration / 60).':'.floor($audio->duration % 60);
        }

        if($request->imageFile!='')
        {
            unlink(storage_path('app/public/'.$music->imagepath));
            $pathImage = $request->file('imageFile')->storeAs('images/'.$loginUser, Str::random().'.'.$request->file('imageFile')->extension(), 'public');
        }


        DB::table('musics')
        ->where('id', $request->id)
        ->update([
            'year' => $request->year,
            'name' => $request->name,
            'author' => $request->author,
            'duration' => $duration,
            'text' => $text,
            'imagepath' => $pathImage,
            'musicpath' => $pathMusic,
            'userId'=>$request->cookie('id')
        ]);
        return redirect('/');
    }
    public function editMusicPage($musicId,Request $request){
        $arrayToSend = array();
        $userId = $request->cookie('id');
        if(is_null($userId)){
            return redirect('login');    
        }
        $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;

        $arrayToSend['music'] = DB::table('musics')->find($musicId);
        
        return view('music/edit',
        $arrayToSend
    );
    }
}