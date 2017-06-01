<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;

use Shoppvel\Http\Requests;
use Shoppvel\User;
use Socialite;
use Auth;
class SocialAuthController extends Controller
{
    public function entrarFacebook(){
    	return Socialite::driver('facebook')->redirect();

    }

    public function retornoFacebook(){
    	$userSocial = Socialite::driver('facebook')->user();
    	$email = $userSocial->getEmail();

   		if (Auth::check()) {
   			$user = Auth::user();
   			$user->facebook = $email;
   			$user->save();
   			return redirect('/');
   		}

   		$user = User::where('facebook', $email)->first();

   		if (isset($user->name)) {
   			Auth::login($user);
   			return redirect('/');
   		}

   		if(User::where('email', $email)->count()){
   			$user = User::where('email', $email)->first();
   			$user->facebook = $email;
   			$user->save();
   			Auth::login($user);
   			return redirect('/');
   		}

   		$u = new User();
   		$u->role = 'cliente';
   		$u->name = $userSocial->getName();
   		$u->email = $userSocial->getEmail();
   		$u->facebook = $userSocial->getEmail();
   		$u->cpf = '33333333333';
   		$u->endereco = '';
   		$u->password = bcrypt($userSocial->token);
   		$u->save();
   		Auth::login($u);
   		return redirect('/');
    }

    public function entrarGoogle(){
      return Socialite::driver('google')->redirect();

    }

    public function retornoGoogle(){
      $userSocial = Socialite::driver('google')->user();
      $email = $userSocial->getEmail();

      if (Auth::check()) {
        $user = Auth::user();
        $user->google = $email;
        $user->save();
        return redirect('/');
      }

      $user = User::where('google', $email)->first();

      if (isset($user->name)) {
        Auth::login($user);
        return redirect('/');
      }

      if(User::where('email', $email)->count()){
        $user = User::where('email', $email)->first();
        $user->google = $email;
        $user->save();
        Auth::login($user);
        return redirect('/');
      }

      $u = new User();
      $u->role = 'cliente';
      $u->name = $userSocial->getName();
      $u->email = $userSocial->getEmail();
      $u->google = $userSocial->getEmail();
      $u->cpf = '33333333333';
      $u->endereco = '';
      $u->password = bcrypt($userSocial->token);
      $u->save();
      Auth::login($u);
      return redirect('/');
    }
}
