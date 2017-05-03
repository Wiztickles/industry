<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Project;
use App\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('deleted',0)->orderBy('id','desc')->take(3)->get();
        $news = News::where('deleted',0)->orderBy('id','desc')->take(3)->get();
        return view('home', compact("projects", "news"));
    }
}
