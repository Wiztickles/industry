<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\ProjectComment;

class ProjectCommentsController extends Controller
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
    	

    	$comment = new ProjectComment;
    	$project_id = $request->get('project_id');

    	$comment->user_id = $request->get('user_id');
    	$comment->project_id = $request->get('project_id');
    	$comment->comment = $request->get('comment');

    	
    	$comment->save();

    	return redirect('/project/'.$project_id);


    }

    public function edit($id)
    {
    	$comment = ProjectComment::find($id);

    	if($comment->user_id != Auth::user()->id || $comment->deleted === 1 ) {
    	    return redirect()->route('home');
    	}
    	
    	return view('/project/edit_comment',compact('comment'));
    }

    public function update($id, Request $request)
    {	
    	$this->validate($request, [
    	    'comment' => 'required',
    	]);

    	$comment = ProjectComment::find($id);

    	$comment->comment = $request->get('comment');
    	$comment->save();
    		
    	return redirect('/project/'.$comment->project_id);
    }

    public function deleteComment($id)
    {
        $comment = ProjectComment::find($id);

        if(Auth::user()->admin != 1 && $comment->user_id != Auth::user()->id || $comment->deleted === 1 ) {
            return redirect()->route('home');
        }
        return view('/project/delete_comment',compact('comment'));
    }

    public function delete($id, Request $request)
    {
        $comment = ProjectComment::find($id);

        $comment->deleted = $request->get('deleted');

        $comment->save();
        return redirect('/project/'.$comment->project_id);
    }
}

