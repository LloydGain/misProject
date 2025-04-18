<?php

namespace App\Http\Controllers;

use App\Models\Likey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $likeModel = new Likey();
        $user = Auth::user();
        $likeData = $likeModel->getLikeJoinProd($user->id);
        
        if(sizeof($likeData) == 0){
            $likeData = null;
        }

        return view('users.membercenter')->with([
            'user' => $user,
            'likeData' => $likeData,
        ]);
    }
}
