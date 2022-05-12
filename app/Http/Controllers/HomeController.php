<?php

namespace App\Http\Controllers;

use App\Models\news;


use Illuminate\Http\Request;

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
        $search = request()->query('search');
        if($search){
            $news = News::where('name_news', 'LIKE', "%{$search}%")->paginate(3);
        }
        else{
            $news = News::paginate(3);
        }
        return view('home', compact('news'));
    }
}
