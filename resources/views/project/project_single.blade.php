@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 flex-row flex-a-center flex-j-between head_btn">
            <h1 class="head_white">Project {{$project->id}}: {{$project->title}}</h1>
            @if(Auth::check())
                @if(Auth::user()->admin === 1)
                    <a href="{{ url('/project/create')}}" class="btn btn-default">Create Project</a>
                @endif
            @endif
        </div>
    </div>
    @if($project->deleted === 1)
        <h2>This Project was deleted</h2>
    @else
        <div class="row gutter-20 lg_top_mar">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="single_notice" class="shad_tile">
                    <p>{!! nl2br($project->description) !!}</p>
                    <a href="{{($project->link) }}">{!! nl2br($project->link) !!}</a>
                    <div class="row lg_top_mar">
                        @if(!empty($project->img_1) )
                            <div class="col-lg-12 col-md-12 col-sm-12 flex-col flex-a-center">
                                <img src="/uploads/project/{{ $project->img_1 }}" style="" class="img-responsive img-thumbnail">
                            </div>
                        @endif
                    </div>
                    <p class="text-right">{{$project->created_at->format('d/m/Y')}}</p>
                    <div class="notice_edit flex-row flex-j-end">
                        @if (Auth::check())
                            @if(Auth::user()->id === $project->user_id)
                                <a href="{{ url('/project/edit/')}}/{{$project->id}}" class="btn btn-link pull-right"><i class="fa fa-btn fa-gear"></i>Edit Post</a>
                            @endif
                            @if(Auth::user()->id === $project->user_id || Auth::user()->admin ===1)
                                <a href="{{ url('/project/delete')}}/{{$project->id}}" class="btn btn-link"><i class="fa fa-btn fa-times"></i>Delete Post</a>
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
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/project/'.$project->id).'/comment' }}">
                                            {{ csrf_field() }}
                                            <input id="project_id" type="hidden" class="" name="project_id" value="{{$project->id}}">
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