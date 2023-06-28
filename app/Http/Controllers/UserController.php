<?php

namespace App\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function registrate(Request $request){

        $users = DB::table('users')->where('email',$request->email);

        if(is_null($users)){
            return view('user/registrate',array(
                'message' => 'Пользователь с таким email уже зарегестрирован'
            ));
        }

        $id = DB::table('users')->insertGetId([
            'login'=>$request->login,
            'password'=>$request->password,
            'email'=>$request->email
        ]);

        return redirect('/')->withCookie(cookie('id', $id,60*24));
    }
    public function registratePage(){
        return view('user/registrate');
    }

    public function profile(Request $request){
        $arrayToSend = array();
        $userId = $request->cookie('id');
        if(is_null($userId)){
        
            return redirect('registrate');
        }
        $arrayToSend['profileImg'] = DB::table('users')->find($userId)->imagepath;
        $arrayToSend['user'] = DB::table('users')->find($userId);

        return view('user/profile',$arrayToSend);
    }

    public function changeUserImage(Request $request){
        $userId = $request->cookie('id');
        if(is_null($userId)){
            return redirect('registrate');
        }
        
        $user = DB::table('users')->find($userId);

        if($request->image!='')
        {
            if($user->imagepath!='userImages/noimage.png')
                unlink(storage_path('app/public/'.$user->imagepath));
            
                $pathImage = $request->file('image')->storeAs('userImages', $request->image->getClientOriginalName(), 'public');
            DB::table('users')
                ->where('id',$userId)
                ->update([
                    'imagepath'=>$pathImage
                ]);
        }

        

        return redirect('profile');
    }

    public function signOut(){
        $cookie = Cookie::forget('id');
        return redirect('/')->withCookie($cookie);
    }

    public function login(Request $request){

        $user = DB::table('users')->where('email',$request->email)->first();

        if(is_null($user)){
            return view('user/login',array(
                'message' => 'Пользователь не найден'
            ));
        }
        
        if($user->password!=$request->password){
            return view('user/login',array(
                'message' => 'Неправильный пароль'
            ));
        }

        return redirect('/')->withCookie(cookie('id', $user->id,60*24));
    }
    public function loginPage(){
        return view('user/login');
    }
}
