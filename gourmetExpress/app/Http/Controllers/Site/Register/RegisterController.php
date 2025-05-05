<?php

namespace App\Http\Controllers\Site\Register;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    public function getShow() {

        return view('pages.site.register.show');  
      }
  
      public function postStore(Request $request)
      {
          
          
          $user = new User();
  
      try {
              $user->firstOrCreate([
                  'name' => $request->name,
                  'lastname' => $request->lastname,
                  'gender' => $request->gender,
                  'email' => $request->email,
                  'password' => Hash::make($request->password),
              ]);
            return redirect()->route('Site-RegisterGetShow')->with('success', 'Utilisateur créé avec succès !, Connectez-vous Maintenant');
  
          } catch (\Exception $e) {
              // Message d'erreur
              return redirect()->back()->with('error', 'Une erreur est survenue lors de la création de l\'utilisateur.'. $e->getMessage());
          }  
          
      }
}
