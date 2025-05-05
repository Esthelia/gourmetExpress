<?php

namespace App\Http\Controllers\Site\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getShow() {

        return view('pages.site.login.show');  
      }
  
      public function postLogin(LoginRequest $request)
      {
    try {
          $credentials = $request->only('email', 'password');
  
          if (Auth::attempt($credentials)) {
          // dd($credentials);
              return redirect()->intended('/')->with('success', 'Utilisateur connecé avec succès !');
          }

        } catch (\Exception $e) {
          
          return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);

        } 
      }


      public function postLogout(Request $request)
      {
          Auth::logout();
          return redirect()->route('Site-LoginGetShow');
      }
}
