<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\BoardUser;
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
        $user_id =  Auth::user()->id;
        $board_id = BoardUser::where("user_id", $user_id)->get('board_id');
        $allBoard = Board::find($board_id);
        return view('home', ['allBoard'=>$allBoard]);
       
    }
}
