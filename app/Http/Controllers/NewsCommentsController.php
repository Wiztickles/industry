<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\NewsComment;
use Carbon\Carbon;
use Auth;

class NewsCommentsController extends Controller
{
   	public function __construct()
   	{
   	    $this->middleware('auth');
   	}

   	public function store($id, Request $request)
   	{
   		$this->validate($request, [
   		    'comment' => 'required',
   		]);
   		

   		$comment = new NewsComment;
   		$news_id = $request->get('news_id');

   		$comment->user_id = $request->get('user_id');
   		$comment->news_id = $request->get('news_id');
   		$comment->comment = $request->get('comment');

   		
   		$comment->save();

   		return redirect('/notice-board/'.$news_id);


   	}

   	public function edit($id)
   	{
   		$comment = NewsComment::find($id);

   		if($comment->user_id != Auth::user()->id || $comment->deleted === 1 ) {
   		    return redirect()->route('home');
   		}
   		
   		return view('/news/edit_comment',compact('comment'));
   	}

   	public function update($id, Request $request)
   	{	
   		$this->validate($request, [
   		    'comment' => 'required',
   		]);

   		$comment = NewsComment::find($id);

   		$comment->comment = $request->get('comment');
   		$comment->save();
   			
   		return redirect('/notice-board/'.$comment->news_id);
   	}

   	public function deleteComment($id)
   	{
   	    $comment = NewsComment::find($id);

   	    if(Auth::user()->admin != 1 && $comment->user_id != Auth::user()->id || $comment->deleted === 1 ) {
   	        return redirect()->route('home');
   	    }
   	    return view('/news/delete_comment',compact('comment'));
   	}

   	public function delete($id, Request $request)
   	{
   	    $comment = NewsComment::find($id);

   	    $comment->deleted = $request->get('deleted');

   	    $comment->save();
   	    return redirect('/notice-board/'.$comment->news_id);
   	}

}
