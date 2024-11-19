<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    
    
      

   function register(Request $request){ 
 
    $data = $request->validate([
        'name'=>'required',
        'phone'=>'required',
        'password'=>'required',
        'username'=>'required',
    ]);
    $user = User::create($data);
    if($user){
        return redirect()->route('login');
    }
}










public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

     $user = User::where('username', $credentials['username'])->first();

     if ($user && $credentials['password'] === $user->password) {
         Auth::login($user);
        return redirect('dashbord');
    } else {
         return back()->withErrors([
         ]);
    }
}


public function logout(Request $request)
{
    Auth::logout(); 
     $request->session()->invalidate();

     $request->session()->regenerateToken();

     return redirect('/login')->with('message', 'Successfully logged out.');
}








 
}



