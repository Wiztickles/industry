@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Delete Project Comment</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/project/comment/delete/'.$comment->id) }}">
                        {{ csrf_field() }}

                        <div class='col-lg-12 comments shad_tile'>
                            <div class="flex-row flex-a-center flex-j-between comment_user">
                                <div>
                                    <img src="/uploads/avatars/{{ $comment->user->avatar }}" style="width:30px; height:30px;" class="img-circle">
                                    <b>{{$comment->user->first_name}} {{$comment->user->last_name}}</b>
                                </div>
                                <span class="pull-right">{{$comment->created_at->format('d-m-Y')}}</span>
                            </div>

                            <div class="comment_content notice_info">
                                <p>{!! nl2br($comment->comment) !!}</p>
                            </div>
                        </div>
                        <hr>
                    
                        <input id="deleted" type="hidden" class="" name="deleted" value="1">

                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="pull-right">
                                    <a href="{{ url('/project/'.$comment->project_id) }}" class="btn btn-success">
                                        <i class="fa fa-btn fa-ban"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-times"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection