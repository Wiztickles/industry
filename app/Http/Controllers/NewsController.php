<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;

use App\News;
use App\User;
use App\NewsComment;
use Carbon\Carbon;
use Auth;



class NewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::where('deleted', '=', 0)->orderBy('id','desc')->with('User')->paginate(10);
        return view('news/news',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/news/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
        ]);


        $news = new News;

        $news->title = $request->get('title');
        $news->description = $request->get('description');
        $news->user_id = $request->get('user_id');
        $news->link = $request->get('link');
        $news->save();

        return redirect('/notice-board/'.$news->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notice = News::find($id);
        $comments = NewsComment::where('news_id', $id)->where('deleted', 0)->orderBy('id','desc')->paginate(10);

        return view('/news/news_single',compact('notice', 'comments'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = News::find($id);

        if($post->user_id != Auth::user()->id || $post->deleted === 1 ) {
            return redirect()->route('home');
        }

        return view('/news/edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = News::find($id);

        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $news->title = $request->get('title');
        $news->link = $request->get('link');
        $news->description = $request->get('description');
        $news->save();

        return redirect('/notice-board/'.$news->id);
    }

    public function delete(Request $request, $id)
    {
        $news = News::find($id);

        $news->deleted = $request->get('deleted');

        $news->save();

        return redirect('/notice-board/'.$news->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePost($id)
    {
        $notice = News::find($id);


        if(Auth::user()->admin != 1 && $notice->user_id != Auth::user()->id || $notice->deleted === 1 ) {
            return redirect()->route('home');
        }
        return view('/news/delete',compact('notice'));
    }
}
