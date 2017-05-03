<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Archive;
use App\User;
use App\ArchiveComment;
use Image;
use File;
use Auth;

class ArchiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archive = Archive::where('deleted', '=', 0)->orderBy('id','desc')->with('User')->paginate(10);
        return view('archive/archive',compact('archive'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/archive/create');
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
            'img_2' => 'image',
            'img_3' => 'image',
        ]);


        $archive = new Archive;

        $archive->title = $request->get('title');
        $archive->description = $request->get('description');
        $archive->user_id = $request->get('user_id');

    	if($request->hasFile('img_1')){
			$img_1 = $request->file('img_1');
			$filename = time().'_'. $img_1->getClientOriginalName();
			Image::make($img_1)->resize(1000, null, function ($constraint) {$constraint->aspectRatio();})->save( public_path('/uploads/archive/'.$filename ) );
			$archive->img_1 = $filename;
		}

    	if($request->hasFile('img_2')){
			$img_2 = $request->file('img_2');
			$filename = time().'_'. $img_2->getClientOriginalName();
			Image::make($img_2)->resize(1000, null, function ($constraint) {$constraint->aspectRatio();})->save( public_path('/uploads/archive/'.$filename ) );
			$archive->img_2 = $filename;
		}

    	if($request->hasFile('img_3')){
			$img_3 = $request->file('img_3');
			$filename = time().'_'.$img_3->getClientOriginalName();
			Image::make($img_3)->resize(1000, null, function ($constraint) {$constraint->aspectRatio();})->save( public_path('/uploads/archive/'.$filename ) );
			$archive->img_3 = $filename;
		}

        $archive->save();

        return redirect('/archive/'.$archive->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $archive = Archive::find($id);
        $comments = ArchiveComment::where('archive_id', $id)->where('deleted', 0)->orderBy('id','desc')->paginate(25);

        return view('/archive/archive_single',compact('archive', 'comments'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $archive = Archive::find($id);

        if($archive->user_id != Auth::user()->id || $archive->deleted === 1 ) {
            return redirect()->route('home');
        }

        return view('/archive/edit',compact('archive'));
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
        $archive = Archive::find($id);

        $old_img1 = $archive->img_1;
        $old_img2 = $archive->img_2;
        $old_img3 = $archive->img_3;

        $path = '/uploads/archive/';

        $archive->title = $request->get('title');
        $archive->description = $request->get('description');
        $archive->user_id = $request->get('user_id');

    	if($request->hasFile('img_1')){
			$img_1 = $request->file('img_1');
			$filename = time().'_'. $img_1->getClientOriginalName();
			Image::make($img_1)->resize(1000, null, function ($constraint) {$constraint->aspectRatio();})->save( public_path('/uploads/archive/'.$filename ) );
			$archive->img_1 = $filename;

			File::Delete(public_path( $path . $old_img1) );
		}

    	if($request->hasFile('img_2')){
			$img_2 = $request->file('img_2');
			$filename = time().'_'. $img_2->getClientOriginalName();
			Image::make($img_2)->resize(1000, null, function ($constraint) {$constraint->aspectRatio();})->save( public_path('/uploads/archive/'.$filename ) );
			$archive->img_2 = $filename;

			File::Delete(public_path( $path . $old_img2) );
		}

    	if($request->hasFile('img_3')){
			$img_3 = $request->file('img_3');
			$filename = time().'_'.$img_3->getClientOriginalName();
			Image::make($img_3)->resize(1000, null, function ($constraint) {$constraint->aspectRatio();})->save( public_path('/uploads/archive/'.$filename ) );
			$archive->img_3 = $filename;

			File::Delete(public_path( $path . $old_img3) );
		}

        $archive->save();

        return redirect('/archive/'.$archive->id);

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePost($id)
    {
        $archive = Archive::find($id);

        if(Auth::user()->admin != 1 && $archive->user_id != Auth::user()->id || $archive->deleted === 1 ) {
            return redirect()->route('home');
        }
        return view('/archive/delete',compact('archive'));
    }

    public function delete(Request $request, $id)
    {
        $archive = Archive::find($id);

        $archive->deleted = $request->get('deleted');

        $archive->save();

        return redirect('/archive/'.$archive->id);
    }
}
