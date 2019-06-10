<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Reward;

class UserController extends Controller
{


    public function __construct(){
        
        $this->middleware('auth');
    
    }

   	public function myprofile(User $user)
   	{
        $user_id = Auth()->user()->id;

   		$this_user = User::where('id',$user_id)->first();

   		return view('user.profile', compact('this_user'));

   	}

   	public function update(User $user)
   	{

		$attr = request()->all(); 
		// dd($attr);
        unset($attr['_method']);
        unset($attr['_token']);

        User::where('id', $user->id)->update($attr);

        return redirect('/profile');
   	}

    public function rewards(Reward $reward)
    {

        $user_id = Auth()->user()->id;
        
        $rewards = Reward::where('user_id',$user_id)->sum('reward_points');
        // dd($rewards);
        return view('user.rewards', compact('rewards'));
    }
}
