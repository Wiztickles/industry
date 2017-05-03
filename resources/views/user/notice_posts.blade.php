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
                        <h2>Notice Board Post</h2>
                    </div>
                </a>
                <div class="">
                    @if($notice->isEmpty())
                        <div class="row gutter-20">
                            <div class="col-lg-12">
                                <div>
                                    <div class='col-lg-12 comments ten_top_mar'>
                                        <div class="comment_content">
                                            <p>This user has  Notice Board Posts</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach($notice as $item)
                            <div class="row gutter-20">
                                <div class="col-lg-12">
                                    <div>
                                        <div class='col-lg-12 shad_tile lg_top_mar'>
                                            <div class="flex-row flex-a-center flex-j-between comment_user">
                                                <div>
                                                    <a href="{{ url('notice-board/')}}/{{$item->id}}">
                                                        <b>{{$item->title}}</b>
                                                    </a>
                                                </div>
                                                <p id="comment_date">{{$item->created_at->format('d/m/Y')}}</p>
                                            </div>

                                            <div class="comment_content notice_info">
                                                <p>{!! nl2br($item->description) !!}</p>
                                                <a href="{{($item->link) }}">{!! nl2br($item->link) !!}</a>
                                            </div>
                                            <div class="notice_edit flex-row flex-j-end">
                                                @if (Auth::check())
                                                    @if(Auth::user()->id === $item->user_id)
                                                        <a href="{{ url('/notice-board/edit/')}}/{{$item->id}}" class="btn btn-link pull-right"><i class="fa fa-btn fa-gear"></i>Edit Post</a>
                                                    @endif
                                                    @if(Auth::user()->id === $item->user_id || Auth::user()->admin === 1)
                                                        <a href="{{ url('/notice-board/delete')}}/{{$item->id}}" class="btn btn-link"><i class="fa fa-btn fa-times"></i>Delete Post</a>
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    </div> 
                                </div>
                            </div>
                        @endforeach
                        <div class="text-right">
                            {{$notice->links()}}
                        </div>
                    @endif       
                </div>
            </div>
        </div>

    </div>


</div>



@endsection