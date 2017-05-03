<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project;
use App\User;
use App\ProjectComment;
use Image;
use File;
use Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    public function index()
    {
        $project = Project::where('deleted', '=', 0)->orderBy('id','desc')->with('User')->paginate(6);
        return view('project/project',compact('project'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->admin != 1) {
            return redirect()->route('home');
        }
        return view('/project/create');
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
                    'img_1' => 'image',
                ]);


                $project = new Project;

                $project->title = $request->get('title');
                $project->description = $request->get('description');
                $project->user_id = $request->get('user_id');

                if($request->hasFile('img_1')){
                    $img_1 = $request->file('img_1');
                    $filename = time().'_'. $img_1->getClientOriginalName();
                    Image::make($img_1)->resize(1000, null, function ($constraint) {$constraint->aspectRatio();})->save( public_path('/uploads/project/'.$filename ) );
                    $project->img_1 = $filename;
                }

                $project->save();

                return redirect('/project/'.$project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        $comments = ProjectComment::where('project_id', $id)->where('deleted', 0)->orderBy('id','desc')->paginate(25);

        return view('/project/project_single',compact('project', 'comments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);

        if(Auth::user()->admin != 1 || $project->deleted === 1 ) {
            return redirect()->route('home');
        }

        return view('/project/edit',compact('project'));
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
                $project = Project::find($id);

                $old_img1 = $project->img_1;

                $path = '/uploads/project/';

                $project->title = $request->get('title');
                $project->description = $request->get('description');
                $project->user_id = $request->get('user_id');

                if($request->hasFile('img_1')){
                    $img_1 = $request->file('img_1');
                    $filename = time().'_'. $img_1->getClientOriginalName();
                    Image::make($img_1)->resize(1000, null, function ($constraint) {$constraint->aspectRatio();})->save( public_path('/uploads/project/'.$filename ) );
                    $project->img_1 = $filename;

                    File::Delete(public_path( $path . $old_img1) );
                }

                $project->save();

                return redirect('/project/'.$project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deletePost($id)
    {
        $project = Project::find($id);

        if(Auth::user()->admin != 1 || $project->deleted === 1 ) {
            return redirect()->route('home');
        }
        return view('/project/delete',compact('project'));
    }

    public function delete(Request $request, $id)
    {
        $project = Project::find($id);

        $project->deleted = $request->get('deleted');

        $project->save();

        return redirect('/project/'.$project->id);
    }

}
