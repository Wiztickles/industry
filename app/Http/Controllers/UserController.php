<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Image;
use File;
use App\User;
use App\ProjectComment;
use App\ArchiveComment;
use App\NewsComment;
use App\News;
use App\Archive;
use Validator;
use Carbon\Carbon;



class UserController extends Controller
{

	public function __construct()
	{
	    $this->middleware('auth')->except('profile', 'projectComments' ,'noticePosts' , 'noticeComments');
	}

    public function profile($id){
    	$user = User::find($id);

        $id = $user->id;
        $projComments = ProjectComment::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(5)->get();
        $archiveComments = ArchiveComment::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(5)->get();
        $noticeComments = NewsComment::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(5)->get();
        $notice = News::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(3)->get();
        $archive = Archive::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(3)->get();

        return view('profile',compact('user','projComments', 'id', 'archiveComments', 'noticeComments' , 'notice' ,'archive'));
    }

    public function profileSingle(){
        $user = Auth::user();
        $id = Auth::user()->id;
        $projComments = ProjectComment::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(5)->get();
        $archiveComments = ArchiveComment::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(5)->get();
        $noticeComments = NewsComment::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(5)->get();
        $notice = News::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(3)->get();
        $archive = Archive::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->take(3)->get();

        return view('profile',compact('user','projComments', 'id', 'archiveComments', 'noticeComments' , 'notice' ,'archive'));
    }

    public function projectComments($id){
        $user = User::find($id);
        $id = $user->id;
        $projComments = ProjectComment::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->paginate(20);

        return view('/user/project_comments',compact('user','projComments'));
    }

    public function noticePosts($id){
        
        $user = User::find($id);
        $id = $user->id;
        $notice = News::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->paginate(10);

        return view('/user/notice_posts',compact('user','notice'));
    }

    public function noticeComments($id){
        $user = User::find($id);
        $id = $user->id;
        $noticeComments = NewsComment::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->paginate(20);

        return view('/user/notice_comments',compact('user','noticeComments'));
    }

    public function archiveComments($id){
        if(!Auth::check()) {
            return redirect()->route('home');
        }
        $user = User::find($id);
        $id = $user->id;
        $archiveComments = ArchiveComment::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->paginate(20);

        return view('/user/archive_comments',compact('user','archiveComments'));
    }

    public function archivePosts($id){
        if(!Auth::check()) {
            return redirect()->route('home');
        }
        $user = User::find($id);
        $id = $user->id;
        $archive = Archive::where('deleted',0)->where('user_id', $id)->orderBy('id','desc')->paginate(10);

        return view('/user/archive_posts',compact('user','archive'));
    }


    public function edit($id, Request $request){

    	$user = User::find($id);

    	if($user->id != Auth::user()->id) {
    		return redirect()->route('home');
    	}

    	return view('/auth/edit',compact('user'));
    }


    public function update($id,Request $request){
    	$user = User::find($id);

    	$this->validate($request, [
    	    'first_name' => 'required|max:255',
    	    'last_name' => 'required|max:255',
    	    'email' => 'required|max:255|unique:users,email,'.$user->id,
    	    'phone_number' => 'required|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/|unique:users,phone_number,'.$user->id,
    	    'avatar' => 'image'
    	]);


    	$user->first_name = $request->get('first_name');
    	$user->last_name = $request->get('last_name');
    	$user->email = $request->get('email');
    	$user->skills = $request->get('skills');
    	$user->bio = $request->get('bio');
    	$user->phone_number = $request->get('phone_number');
    	$user->recive_text_updates = $request->get('recive_text_updates');

    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time().'.'. $avatar->getClientOriginalExtension();
    		Image::make($avatar)->fit(300,300)->save( public_path('/uploads/avatars/'.$filename ) );

    		// delete users old image add this before uplading the new image.
    		if (Auth::user()->avatar != "default.jpg") {
				$path = '/uploads/avatars/';
				$lastpath= Auth::user()->avatar;
				File::Delete(public_path( $path . $lastpath) );
    		}
    		$user = Auth::user();

    		$user->avatar = $filename;
    		$user->save();
    	}

    	$user->save();
    	return redirect('/profile/'.$user->id);
    }
}
