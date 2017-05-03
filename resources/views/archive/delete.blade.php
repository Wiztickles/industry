@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Delete Archive Post</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/archive/delete/'.$archive->id) }}">
                        {{ csrf_field() }}

                        <div id="delete-notice" class="shad_tile">
                            <h3>{{$archive->title}}</h3>
                            <p>{!! nl2br($archive->description) !!}</p>
                            <div class="row lg_top_mar">
                                @if(!empty($archive->img_1) )
                                    <div class="col-lg-4">
                                        <img src="/uploads/archive/{{ $archive->img_1 }}" style="" class="img-responsive img-thumbnail">
                                    </div>
                                @endif
                                @if(!empty($archive->img_2) )
                                    <div class="col-lg-4">
                                        <img src="/uploads/archive/{{ $archive->img_2 }}" style="" class="img-responsive img-thumbnail">
                                    </div>
                                @endif
                                @if(!empty($archive->img_3) )
                                    <div class="col-lg-4">
                                        <img src="/uploads/archive/{{ $archive->img_3 }}" style="" class="img-responsive img-thumbnail">
                                    </div>
                                @endif
                            </div>
                            <hr>
                            <div class="text-right">
                                <p>Created: {{$archive->created_at->format('d/m/Y')}}</p>
                            </div>
                        </div>
                        <hr>
                    
                        <input id="deleted" type="hidden" class="" name="deleted" value="1">

                        <div class="form-group">
                            <div class="col-lg-12">
                                <div class="pull-right">
                                    <a href="{{ url('/archive/'.$archive->id) }}" class="btn btn-success">
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