<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function calllbackFacebook()
    {
        try {
            $fb_user = Socialite::driver('facebook')->user();
            $user = User::where('facebook_id', $fb_user->id)->first();

            if(!$user){
                $new_user = User::create([
                    'name' => $fb_user->name,
                    'email' => $fb_user->email,
                    'facebook_id' => $fb_user->id,

                ]);

                Auth::login($new_user);

                return redirect()->intended('/');
            }else{
                Auth::login($user);

                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
           dd('something went wrong!', $th->getMessage());
        }
    }
}
