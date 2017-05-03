@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Edit Comment on: {{$comment->news->title}}</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/notice-board/comment/edit/'.$comment->id) }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">

                            <div class="col-lg-12">
                            <textarea id="comment" name="comment" class="form-control" rows="5" placeholder="Comment on this Notice">{{$comment->comment}}</textarea>

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
                                    <i class="fa fa-btn fa-gear"></i> Edit Comment
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection