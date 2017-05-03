@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 flex-row flex-a-center flex-j-between head_btn">
            <a href="{{url('notice-board')}}"><h1 class="head_white">Notice Board</h1></a>
            @if(Auth::check())
                <a href="{{ url('/notice-board/create')}}" class="btn btn-default">Create a new notice</a>
            @endif
        </div>
    </div>
    @if($notice->deleted === 1)
        <h2>This Notice Board Post was deleted</h2>
    @else
        <div class="row gutter-20 lg_top_mar">
            <div class="col-lg-2 md_hide">
                <div class="shad_tile flex-col flex-a-center text-center">
                    <img src="/uploads/avatars/{{ $notice->user->avatar }}" style="width:100px; height:100px;" class="img-circle">
                    <a href="{{url('profile')}}/{{$notice->user_id}}"><h3>{{$notice->user->first_name}} {{$notice->user->last_name}}</h3></a>
                </div>
            </div>

            <div class="col-md-2 col-sm-2 col-xs-12 lg_hide">
                <div class="shad_tile flex-col flex-a-center text-center">
                    <img src="/uploads/avatars/{{ $notice->user->avatar }}" style="width:50px; height:50px;" class="img-circle">
                    <a href="{{url('profile')}}/{{$notice->user_id}}"><h5>{{$notice->user->first_name}} {{$notice->user->last_name}}</h5></a>
                </div>
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <div id="single_notice" class="shad_tile">
                    <h3>{{$notice->title}}</h3>
                    <p>{!! nl2br($notice->description) !!}</p>
                    <a href="{{($notice->link) }}">{!! nl2br($notice->link) !!}</a>
                    <p class="text-right">{{$notice->created_at->format('d/m/Y')}}</p>
                    <div class="sm_user_info flex-row flex-a-center">
                        <img src="/uploads/avatars/{{ $notice->user->avatar }}" style="width:20px; height:20px;" class="img-circle">
                        <a href="{{url('profile')}}/{{$notice->user_id}}"><p><b>{{$notice->user->first_name}} {{$notice->user->last_name}}</b></p></a>
                    </div>
                    <div class="notice_edit flex-row flex-j-end">
                        @if (Auth::check())
                            @if(Auth::user()->id === $notice->user_id)
                                <a href="{{ url('/notice-board/edit/')}}/{{$notice->id}}" class="btn btn-link pull-right"><i class="fa fa-btn fa-gear"></i>Edit Post</a>
                            @endif
                            @if(Auth::user()->id === $notice->user_id || Auth::user()->admin === 1)
                                <a href="{{ url('/notice-board/delete')}}/{{$notice->id}}" class="btn btn-link"><i class="fa fa-btn fa-times"></i>Delete Post</a>
                            @endif
                        @endif
                    </div>
                </div>

                <div id="single_notice" class="shad_tile lg_top_mar">
                    <h3>Comments</h3>
                    @if(Auth::check())
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div id="pad_bot_remove" class="panel-body">
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/notice-board/'.$notice->id).'/comment' }}">
                                            {{ csrf_field() }}
                                            <input id="news_id" type="hidden" class="" name="news_id" value="{{$notice->id}}">
                                            <input id="user_id" type="hidden" class="" name="user_id" value={{Auth::user()->id}}>

                                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                                                <div class="col-lg-12">
                                                <textarea id="comment" name="comment" class="form-control" rows="2" placeholder="Comment on this Notice"></textarea>

                                                    @if ($errors->has('comment'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('comment') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <button type="submit" class="btn btn-primary pull-right">
                                                        <i class="fa fa-btn fa-comment"></i> Comment
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($comments->isEmpty())
                        <div class="row gutter-20">
                            <div class="col-lg-12">
                                <div>
                                    <div class='col-lg-12 comments'>
                                        <div class="comment_content">
                                            <p>There are no comments on this notice</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($comments as $comment)
                            <div class="row gutter-20">
                                <div class="col-lg-12">
                                    <div>
                                        <div class='col-lg-12 comments'>
                                            <div class="flex-row flex-a-center flex-j-between comment_user">
                                                <div>
                                                    <a href="{{ url('profile/')}}/{{$comment->user->id}}">
                                                        <img src="/uploads/avatars/{{ $comment->user->avatar }}" style="width:30px; height:30px;" class="img-circle">
                                                        <b>{{$comment->user->first_name}} {{$comment->user->last_name}}</b>
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
                        <div class="flex-row flex-j-end">
                            {{ $comments->links() }}
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
    @endif


@endsection