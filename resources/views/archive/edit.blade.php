@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Edit Archive Post</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/archive/edit/'.$archive->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" placeholder="Post Title" value="{{ old('title',$archive->title) }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                            <textarea id="description" name="description" class="form-control" rows="5" placeholder="Post Description">{{ old('description',$archive->description) }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <span>Leave File Blank if you want to use existing images</span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('img_1') ? ' has-error' : '' }}">
                            <label for="img_1" class="col-md-4 control-label">Choose Image 1</label>

                            <div class="col-md-6">
                                <input type="file" name="img_1" id="img_1">
                                @if ($errors->has('img_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('img_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('img_2') ? ' has-error' : '' }}">
                            <label for="img_2" class="col-md-4 control-label">Choose Image 2</label>

                            <div class="col-md-6">
                                <input type="file" name="img_2" id="img_2">
                                @if ($errors->has('img_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('img_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('img_3') ? ' has-error' : '' }}">
                            <label for="img_3" class="col-md-4 control-label">Choose Image 3</label>

                            <div class="col-md-6">
                                <input type="file" name="img_3" id="img_3">
                            </div>
                            @if ($errors->has('img_3'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('img_3') }}</strong>
                                </span>
                            @endif
                        </div>

                        <input id="user_id" type="hidden" class="" name="user_id" value="{{Auth::user()->id}}">



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-btn fa-newspaper-o"></i> Edit Post
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