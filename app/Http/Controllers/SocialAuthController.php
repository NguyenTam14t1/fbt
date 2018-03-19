<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite, Auth, Redirect, Session, URL;
use App\Models\User;
use File;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        if (!Session::has('pre_url')) {
            Session::put('pre_url', URL::previous());
        } elseif (URL::previous() != route('login')) { 
            Session::put('pre_url', URL::previous());
        }

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        
        return Redirect::to(Session::get('pre_url'));
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        
        if ($authUser) {
            return $authUser;
        }

        $fileContents = file_get_contents($user->getAvatar());
        $avatarName = time() . rand(1, 1000) . config('setting.avatar_extension');
        File::put(public_path(config('setting.avatar_upload_folder') . $avatarName), $fileContents);
        
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'avatar' => $avatarName,
            'provider' => $provider,
            'provider_id' => $user->id,
        ]);
    }
}
