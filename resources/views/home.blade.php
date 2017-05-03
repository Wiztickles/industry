@extends('layouts.app')

@section('content')
<div class="container">
    <div class="shad_tile">
        <div class="row gutter-20">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <img src=/images/logo.png class="img-responsive">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Our Mission</h2>
                <p>The alan and aida project is a charity concept I am working on for 2017 and is planned to be launched in 2018. The charities focus is to do the following;</p>
                <ol>
                    <li>Maximise our potential as a unit</li>
                    <li>Help and provide support to local and wider people/communities/groups</li>
                    <li>Empower by action</li>
                    <li>Inspire family connectivity through the generations</li>
                </ol>
            </div>
        </div>
    </div>
    <h2 class="head_white lg_top_mar">Recent Projects</h2>
    <div class="row gutter-20">
        @foreach($projects as $item)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 lg_top_mar">
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
    <h2 class="head_white lg_top_mar">Recent Notices</h2>
    <div class="row gutter-20">
            @foreach($news as $item)
                <div class="col-lg-4  col-md-4 col-sm-12 col-xs-12 lg_top_mar">
                    <div class="shad_tile">
                        <div class="row notice">
                            <div class="col-lg-12 col-sm-12 notice ">
                                <div class="notice_user flex-row flex-a-center">
                                    <a href="{{ url('/profile')}}/{{$item->user->id}}" class="notice_user_link">
                                         <img src="/uploads/avatars/{{ $item->user->avatar }}" style="width:50px; height:50px;" class="img-circle">
                                    </a>
                                    <div>
                                        <a href="{{ url('/profile')}}/{{$item->user->id}}" class="notice_user_link">
                                            <h3>{{$item->user->first_name}} {{$item->user->last_name}}</h3>
                                        </a>
                                    </div>
                                </div>
                                <div class=" notice_info">
                                    
                                    <a href="{{ url('/notice-board')}}/{{$item->id}}">
                                        <div class="notice_link">
                                            <h3>{{$item->title}}</h3>
                                            <p>{!! nl2br($item->description) !!}</p>
                                        </div>
                                    </a>
                                    <a href="{!! nl2br($item->link) !!}" class="norm_link">{!! nl2br($item->link) !!}</a>
                                    <div class="text-right">
                                        <p>{{$item->created_at->format('d/m/Y')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>

</div>
@endsection
