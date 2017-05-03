<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\ArchiveComment;
use Auth;

class ArchiveCommentsController extends Controller
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
		

		$comment = new ArchiveComment;
		$archive_id = $request->get('archive_id');

		$comment->user_id = $request->get('user_id');
		$comment->archive_id = $request->get('archive_id');
		$comment->comment = $request->get('comment');

		
		$comment->save();

		return redirect('/archive/'.$archive_id);


	}

	public function edit($id)
	{
		$comment = ArchiveComment::find($id);

		if($comment->user_id != Auth::user()->id || $comment->deleted === 1 ) {
		    return redirect()->route('home');
		}
		
		return view('/archive/edit_comment',compact('comment'));
	}

	public function update($id, Request $request)
	{	
		$this->validate($request, [
		    'comment' => 'required',
		]);

		$comment = ArchiveComment::find($id);

		$comment->comment = $request->get('comment');
		$comment->save();
			
		return redirect('/archive/'.$comment->archive_id);
	}

	public function deleteComment($id)
	{
	    $comment = ArchiveComment::find($id);

	    if(Auth::user()->admin != 1 && $comment->user_id != Auth::user()->id || $comment->deleted === 1 ) {
	        return redirect()->route('home');
	    }
	    return view('/archive/delete_comment',compact('comment'));
	}

	public function delete($id, Request $request)
	{
	    $comment = ArchiveComment::find($id);

	    $comment->deleted = $request->get('deleted');

	    $comment->save();
	    return redirect('/archive/'.$comment->archive_id);
	}	
}
