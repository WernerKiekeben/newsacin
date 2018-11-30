<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\News;
use Auth;
use DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = DB::table('news')
                    ->join('state', 'news.idState' ,'=', 'state.id')
                    ->select('news.*', 'state.description')
                    ->where('news.idUser', '=', Auth::id())
                    ->latest()
                    ->orderBy('created_at','desc')
                    ->limit(10)
                    ->get();

        return view('/home')->with('news', $news);
    }
}
