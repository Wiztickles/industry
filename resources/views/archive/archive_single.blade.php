@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 flex-row flex-a-center flex-j-between head_btn">
            <a href="{{url('archive')}}"><h1 class="head_white">Archive</h1></a>
            @if(Auth::check())
                <a href="{{ url('/archive/create')}}" class="btn btn-default">Create Archive Post</a>
            @endif
        </div>
    </div>
    @if($archive->deleted === 1)
        <h2>This Archive Post was deleted</h2>
    @else
        <div class="row gutter-20 lg_top_mar">
            <div class="col-lg-2 md_hide">
                <div class="shad_tile flex-col flex-a-center text-center">
                    <img src="/uploads/avatars/{{ $archive->user->avatar }}" style="width:100px; height:100px;" class="img-circle">
                    <a href="{{url('profile')}}/{{$archive->user_id}}"><h3>{{$archive->user->first_name}} {{$archive->user->last_name}}</h3></a>
                </div>
            </div>

            <div class="col-md-2 col-sm-2 col-xs-12 lg_hide">
                <div class="shad_tile flex-col flex-a-center text-center">
                    <img src="/uploads/avatars/{{ $archive->user->avatar }}" style="width:50px; height:50px;" class="img-circle">
                    <a href="{{url('profile')}}/{{$archive->user_id}}"><h5>{{$archive->user->first_name}} {{$archive->user->last_name}}</h5></a>
                </div>
            </div>

            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                <div id="single_notice" class="shad_tile">
                    <h3>{{$archive->title}}</h3>
                    <p>{!! nl2br($archive->description) !!}</p>
                    <a href="{{($archive->link) }}">{!! nl2br($archive->link) !!}</a>
                    <div class="sm_user_info flex-row flex-a-center">
                        <img src="/uploads/avatars/{{ $archive->user->avatar }}" style="width:20px; height:20px;" class="img-circle">
                        <a href="{{url('profile')}}/{{$archive->user_id}}"><p><b>{{$archive->user->first_name}} {{$archive->user->last_name}}</b></p></a>
                    </div>
                    <div class="row lg_top_mar">
                        @if(!empty($archive->img_1) )
                            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 flex-col flex-a-center">
                                <img src="/uploads/archive/{{ $archive->img_1 }}" style="" class="img-responsive img-thumbnail">
                            </div>
                        @endif
                        @if(!empty($archive->img_2) )
                            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1  col-sm-offset-1 col-lg-offset-1 col-sm-10 col-lg-offset-1 flex-col flex-a-center">
                                <img src="/uploads/archive/{{ $archive->img_2 }}" style="" class="img-responsive img-thumbnail">
                            </div>
                        @endif
                        @if(!empty($archive->img_3) )
                            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 flex-col flex-a-center">
                                <img src="/uploads/archive/{{ $archive->img_3 }}" style="" class="img-responsive img-thumbnail">
                            </div>
                        @endif
                    </div>
                    <p class="text-right">{{$archive->created_at->format('d/m/Y')}}</p>
                    <div class="notice_edit flex-row flex-j-end">
                        @if (Auth::check() && Auth::user()->id === $archive->user_id) 
                            <a href="{{ url('/archive/edit/')}}/{{$archive->id}}" class="btn btn-link pull-right"><i class="fa fa-btn fa-gear"></i>Edit Post</a>
                        @endif
                        @if (Auth::check() && Auth::user()->id === $archive->user_id || Auth::user()->admin ===1) 
                            <a href="{{ url('/archive/delete')}}/{{$archive->id}}" class="btn btn-link"><i class="fa fa-btn fa-times"></i>Delete Post</a>
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
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/archive/'.$archive->id).'/comment' }}">
                                            {{ csrf_field() }}
                                            <input id="archive_id" type="hidden" class="" name="archive_id" value="{{$archive->id}}">
                                            <input id="user_id" type="hidden" class="" name="user_id" value={{Auth::user()->id}}>

                                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                                                <div class="col-lg-12">
                                                <textarea id="comment" name="comment" class="form-control" rows="2" placeholder="Comment on this Post"></textarea>

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
                                            <p>There are no comments on this post</p>
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