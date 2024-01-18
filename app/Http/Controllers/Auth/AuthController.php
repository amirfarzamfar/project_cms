<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider($provider){

         return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider){

        try {
            $socialite_user =  Socialite::driver($provider)->user();
        }catch (\Exception $ex){
            return redirect()->route('login');
        }

        }
}
