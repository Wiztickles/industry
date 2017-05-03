@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Delete Notice Board Post</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/notice-board/delete/'.$notice->id) }}">
                        {{ csrf_field() }}

                        <div id="delete-notice" class="shad_tile">
                            <h3>{{$notice->title}}</h3>
                            <p>{!! nl2br($notice->description) !!}</p>
                            <p>{{$notice->link}}</p>
                        </div>
                        <hr>
                    
                        <input id="deleted" type="hidden" class="" name="deleted" value="1">

                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="pull-right">
                                    <a href="{{ url('/notice-board/'.$notice->id) }}" class="btn btn-success">
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