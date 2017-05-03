@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 flex-row flex-a-center flex-j-between head_btn">
            <h1 class="head_white">Projects</h1>
            @if(Auth::check())
                @if(Auth::user()->admin === 1)
                    <a href="{{ url('/project/create')}}" class="btn btn-default">Create Project</a>
                @endif
            @endif
        </div>
    </div>

    <div class="row gutter-20">
            @foreach($project as $item)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 lg_top_mar">
                <div class="shad_tile project">
                    <div class="row notice">
                        <div class="col-lg-12 col-sm-12 proj-tile">                           
                            <a href="{{ url('/project')}}/{{$item->id}}">
                                <div class="proj-head">
                                    <div class="notice_link">
                                        <h3>{{$item->title}}</h3>
                                    </div>
                                </div>
                                <div class="proj-img" style="background-image: url(/uploads/project/{{ $item->img_1 }}")>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="flex-row flex-j-end paginate">
            {{ $project->links() }}
        </div>
    </div> 
</div>

@endsection
