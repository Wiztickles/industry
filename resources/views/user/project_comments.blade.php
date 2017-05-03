@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row gutter-20">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="shad_tile flex-col flex-a-center text-center">
                <img src="/uploads/avatars/{{ $user->avatar }}" style="width:100px; height:100px;" class="img-circle">
                <a href="{{url('profile')}}/{{$user->id}}"><h3>{{$user->first_name}} {{$user->last_name}}</h3></a>
            </div>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
            <div class="">
                <a id="profile_drop_head">
                    <div class="shad_tile sm_top_mar md_top_mar">
                        <h2>Project Comments</h2>
                    </div>
                </a>
                <div class="ten_top_mar">
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
                        <div class="text-right">
                            {{$projComments->links()}}
                        </div>
                    @endif       
                </div>
            </div>
        </div>

    </div>


</div>



@endsection