@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row gutter-20">
        <div class="col-lg-4 col-md-5 col-sm-5">
            <div class="shad_tile">
                <div class="flex-col flex-a-stretch">
                    <div class="flex-col flex-a-center">
                        <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px;" class="img-circle">
                        <div class="text-center">
                            <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
                        </div>
                    </div>
                    <div class="prof_user_info col-lg-12">
                        <p><b>Email:</b> {{ $user->email }}</p>
                        <p><b>Skills:</b> {{ $user->skills }}</p>
                        @if(Auth::check())
                            @if(Auth::user()->id === $user->id && $user->bio != "")
                                <p><b>Bio:</b> {!! nl2br($user->bio) !!}</p>
                            @else
                                <p><b>Bio:</b> Edit your profile. Tell us about yourself.</p>
                            @endif
                        @else
                            <p><b>Bio:</b> {!! nl2br($user->bio) !!}</p>
                        @endif
                        

                        @if (Auth::check() && Auth::user()->id === $user->id) 
                            <a href="{{ url('/profile/edit/')}}/{{$user->id}}" class="btn btn-link pull-right"><i class="fa fa-btn fa-gear"></i>Edit Profile</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-7 col-sm-7" id="accordin">
            <div class="">
                <a id="profile_drop_head" data-toggle="collapse" data-parent="#accordin" href="#collapse1">
                    <div class="shad_tile sm_top_mar">
                        <h2>Project Comments <i class="fa fa-caret-down" aria-hidden="true"></i></h2>
                    </div>
                </a>
                <div id="collapse1" class="ten_top_mar collapse">
                    @if($projComments->isEmpty())
                        <div class="row gutter-20">
                            <div class="col-lg-12">
                                <div>
                                    <div class='col-lg-12 comments'>
                                        <div class="comment_content">
                                            <p>This user has no Project Comments</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($projComments as $comment)
                        <div class="row gutter-20">
                            <div class="col-lg-12">
                                <div row gutter-20>
                                    <div class='col-lg-12 comments'>
                                        <div class="flex-row flex-a-center flex-j-between comment_user">
                                            <div>
                                                <a href="{{ url('project/')}}/{{$comment->project_id}}">
                                                    <b>{{$comment->project->title}}</b>
                                                </a>
                                            </div>
                                            <p id="comment_date">{{$comment->created_at->format('d/m/Y')}}</p>
                                        </div>

                                        <div class="comment_content">
                                            <p>{!! nl2br($comment->comment) !!}</p>
                                        </div>
                                        <div class="flex-row flex-j-end">
                                            @if (Auth::check())
                                                @if(Auth::user()->id === $comment->user_id) 
                                                    <a href="{{ url('/project/comment/edit')}}/{{$comment->id}}" class="btn btn-link"><i class="fa fa-btn fa-gear"></i>Edit Comment</a>
                                                @endif
                                                @if(Auth::user()->id === $comment->user_id || Auth::user()->admin ===1)
                                                    <a href="{{ url('/project/comment/delete')}}/{{$comment->id}}" class="btn btn-link"><i class="fa fa-btn fa-times"></i>Delete Comment</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        @endforeach
                        <div class="text-right shad_tile">
                            <a href="{{ url('profile')}}/{{$id}}/project-comments"><button class="btn btn-link" >View all Project Comments</button></a>
                        </div>
                    @endif       
                </div>
            </div>
            <div class="lg_top_mar">
                <a id="profile_drop_head" data-toggle="collapse" data-parent="#accordin" href="#collapse5">
                    <div class="shad_tile sm_top_mar">
                        <h2>Notice Board Post <i class="fa fa-caret-down" aria-hidden="true"></i></h2>
                    </div>
                </a>
                <div id="collapse5" class="collapse">
                    @if($notice->isEmpty())
                        <div class="row gutter-20">
                            <div class="col-lg-12">
                                <div>
                                    <div class='col-lg-12 comments ten_top_mar'>
                                        <div class="comment_content">
                                            <p>This user has no Notice Board Posts</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($notice as $item)
                            <div class="row gutter-20">
                                <div class="col-lg-12">
                                    <div>
                                        <div class='col-lg-12 shad_tile ten_top_mar'>
                                            <div class="flex-row flex-a-center flex-j-between comment_user">
                                                <div>
                                                    <a href="{{ url('notice-board/')}}/{{$item->id}}">
                                                        <b>{{$item->title}}</b>
                                                    </a>
                                                </div>
                                                <p id="comment_date">{{$item->created_at->format('d/m/Y')}}</p>
                                            </div>

                                            <div class="comment_content notice_info">
                                                <p>{!! nl2br($item->description) !!}</p>
                                                <a href="{{($item->link) }}">{!! nl2br($item->link) !!}</a>
                                            </div>
                                            <div class="notice_edit flex-row flex-j-end">
                                                @if (Auth::check())
                                                    @if(Auth::user()->id === $item->user_id)
                                                        <a href="{{ url('/notice-board/edit/')}}/{{$item->id}}" class="btn btn-link pull-right"><i class="fa fa-btn fa-gear"></i>Edit Post</a>
                                                    @endif
                                                    @if(Auth::user()->id === $item->user_id || Auth::user()->admin === 1)
                                                        <a href="{{ url('/notice-board/delete')}}/{{$item->id}}" class="btn btn-link"><i class="fa fa-btn fa-times"></i>Delete Post</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        @endforeach
                        <div class="text-right shad_tile ten_top_mar">
                            <a href="{{ url('profile')}}/{{$id}}/notice-board-posts"><button class="btn btn-link" >View all Notice Board Posts</button></a>
                        </div>
                    @endif       
                </div>
            </div>
            <div class="lg_top_mar">
                <a id="profile_drop_head" data-toggle="collapse" data-parent="#accordin" href="#collapse3">
                    <div class="shad_tile sm_top_mar">
                        <h2>Notice Board Comments <i class="fa fa-caret-down" aria-hidden="true"></i></h2>
                    </div>
                </a>
                <div id="collapse3" class="ten_top_mar collapse">
                    @if($noticeComments->isEmpty())
                        <div class="row gutter-20">
                            <div class="col-lg-12">
                                <div>
                                    <div class='col-lg-12 comments'>
                                        <div class="comment_content">
                                            <p>This user has no Notice Board Comments</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($noticeComments as $comment)
                        <div class="row gutter-20">
                            <div class="col-lg-12">
                                <div row gutter-20>
                                    <div class='col-lg-12 comments'>
                                        <div class="flex-row flex-a-center flex-j-between comment_user">
                                            <div>
                                                <a href="{{ url('notice-board/')}}/{{$comment->news_id}}">
                                                    <b>{{$comment->news->title}}</b>
                                                </a>
                                            </div>
                                            <p id="comment_date">{{$comment->created_at->format('d/m/Y')}}</p>
                                        </div>

                                        <div class="comment_content">
                                            <p>{!! nl2br($comment->comment) !!}</p>
                                        </div>
                                        <div class="flex-row flex-j-end">
                                            @if (Auth::check())
                                                @if(Auth::user()->id === $comment->user_id) 
                                                    <a href="{{ url('/notice-board/comment/edit')}}/{{$comment->id}}" class="btn btn-link"><i class="fa fa-btn fa-gear"></i>Edit Comment</a>
                                                @endif
                                                @if(Auth::user()->id === $comment->user_id || Auth::user()->admin ===1)
                                                    <a href="{{ url('/notice-board/comment/delete')}}/{{$comment->id}}" class="btn btn-link"><i class="fa fa-btn fa-times"></i>Delete Comment</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        @endforeach
                        <div class="shad_tile text-right">
                            <a href="{{ url('profile')}}/{{$id}}/notice-board-comments"><button class="btn btn-link" >View all Notice Board Comments</button></a>
                        </div>
                    @endif       
                </div>
            </div>
            @if(Auth::check())
                <div class="lg_top_mar">
                    <a id="profile_drop_head" data-toggle="collapse" data-parent="#accordin" href="#collapse4">
                        <div class="shad_tile sm_top_mar">
                            <h2>Archive Post <i class="fa fa-caret-down" aria-hidden="true"></i></h2>
                        </div>
                    </a>
                    <div id="collapse4" class="collapse">
                        @if($archive->isEmpty())
                            <div class="row gutter-20">
                                <div class="col-lg-12">
                                    <div>
                                        <div class='col-lg-12 comments ten_top_mar'>
                                            <div class="comment_content">
                                                <p>This user has no Archive Posts</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach($archive as $item)
                                <div class="row gutter-20">
                                    <div class="col-lg-12">
                                        <div>
                                            <div class='col-lg-12 shad_tile ten_top_mar'>
                                                <div class="flex-row flex-a-center flex-j-between comment_user">
                                                    <div>
                                                        <a href="{{ url('archive/')}}/{{$item->id}}">
                                                            <b>{{$item->title}}</b>
                                                        </a>
                                                    </div>
                                                    <p id="comment_date">{{$item->created_at->format('d/m/Y')}}</p>
                                                </div>

                                                <div class="comment_content notice_info">
                                                    <p>{!! nl2br($item->description) !!}</p>
                                                    <a href="{{($item->link) }}">{!! nl2br($item->link) !!}</a>
                                                    <div class="flex-row">
                                                        @if(!empty($item->img_1) )
                                                            <div class="sq_img">
                                                                <img src="/uploads/archive/{{ $item->img_1 }}" style="" class="img-responsive">
                                                            </div>
                                                        @endif
                                                        @if(!empty($item->img_2) )
                                                            <div class=" sq_img">
                                                                <img src="/uploads/archive/{{ $item->img_2 }}" style="" class="img-responsive">
                                                            </div>
                                                        @endif
                                                        @if(!empty($item->img_3) )
                                                            <div class=" sq_img">
                                                                <img src="/uploads/archive/{{ $item->img_3 }}" style="" class="img-responsive">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="notice_edit flex-row flex-j-end">
                                                    @if (Auth::check() && Auth::user()->id === $item->user_id) 
                                                        <a href="{{ url('/archive/edit/')}}/{{$item->id}}" class="btn btn-link pull-right"><i class="fa fa-btn fa-gear"></i>Edit Post</a>
                                                    @endif
                                                    @if (Auth::check() && Auth::user()->id === $item->user_id || Auth::user()->admin ===1) 
                                                        <a href="{{ url('/archive/delete')}}/{{$item->id}}" class="btn btn-link"><i class="fa fa-btn fa-times"></i>Delete Post</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-right shad_tile ten_top_mar">
                                <a href="{{ url('profile')}}/{{$id}}/archive-posts"><button class="btn btn-link" >View all Archive Posts</button></a>
                            </div>
                        @endif       
                    </div>
                </div>
                <div class="lg_top_mar">
                    <a id="profile_drop_head" data-toggle="collapse" data-parent="#accordin" href="#collapse2">
                        <div class="shad_tile sm_top_mar">
                            <h2>Archive Comments <i class="fa fa-caret-down" aria-hidden="true"></i></h2>
                        </div>
                    </a>
                    <div id="collapse2" class=" ten_top_mar collapse">
                        @if($archiveComments->isEmpty())
                            <div class="row gutter-20">
                                <div class="col-lg-12">
                                    <div>
                                        <div class='col-lg-12 comments'>
                                            <div class="comment_content">
                                                <p>This user has no Archive Comments</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach($archiveComments as $comment)
                            <div class="row gutter-20">
                                <div class="col-lg-12">
                                    <div>
                                        <div class='col-lg-12 comments'>
                                            <div class="flex-row flex-a-center flex-j-between comment_user">
                                                <div>
                                                    <a href="{{ url('archive/')}}/{{$comment->archive_id}}">
                                                        <b>{{$comment->archive->title}}</b>
                                                    </a>
                                                </div>
                                                <p id="comment_date">{{$comment->created_at->format('d/m/Y')}}</p>
                                            </div>

                                            <div class="comment_content">
                                                <p>{!! nl2br($comment->comment) !!}</p>
                                            </div>
                                            <div class="flex-row flex-j-end">
                                                @if (Auth::check() && Auth::user()->id === $comment->user_id) 
                                                    <a href="{{ url('/archive/comment/edit')}}/{{$comment->id}}" class="btn btn-link"><i class="fa fa-btn fa-gear"></i>Edit Comment</a>
                                                @endif
                                                @if (Auth::check() && Auth::user()->id === $comment->user_id || Auth::user()->admin ===1) 
                                                    <a href="{{ url('/archive/comment/delete')}}/{{$comment->id}}" class="btn btn-link"><i class="fa fa-btn fa-times"></i>Delete Comment</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            @endforeach
                            <div class="shad_tile text-right">
                                <a href="{{ url('profile')}}/{{$id}}/archive-comments"><button class="btn btn-link" >View all Archive Comments</button></a>
                            </div>
                        @endif       
                    </div>
                </div>
            @endif

        </div>


    </div>
</div>
@endsection
